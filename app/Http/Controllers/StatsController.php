<?php
/**
 * Created by PhpStorm.
 * User: dominique
 * Date: 06/02/2016
 * Time: 06:36
 */

namespace cbs\Http\Controllers;

use cbs\Data_operateur;
use cbs\DefautsAutomate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($materiel = null)
    {
        // Est-ce qu'une date de début et de fin est passé en paramètre, sinon on prend le dernier mois
        if (Input::get('daterangepicker_start') && Input::get('daterangepicker_end')) {
            $startDate = HomeController::reOrderDate(Input::get('daterangepicker_start'));
            $endDate = HomeController::reOrderDate(Input::get('daterangepicker_end'));
            $urlStartAndEndDate = '?daterangepicker_start=' . date('m-d-Y', strtotime($startDate)) .
                '&daterangepicker_end=' . date('m-d-Y', strtotime($endDate));
        } else {
            $startDate = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, date("d"), date("Y")));
            $endDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
            $urlStartAndEndDate = '';
        }

        $devices = [
            'nombre_agent',
            'intervenant',
            'mobile',
            'numero_canton',
            'numero_convoyeur',
            'defaut_eds',
            'defaut_tomographe',
            'saturation_chute',
            'cause',
            'mode_de_defaillance',
            'symptome',
        ];

        $datas = Data_operateur::getNumberOfProblemByDevice($startDate, $endDate, $devices);

        $viewDatas = [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'urlStartAndEndDate' => $urlStartAndEndDate
        ];
        switch ($materiel) {
            case 'statsMobiles' :
                $mobiles = self::getDefautsMobiles($startDate, $endDate);
                array_shift($datas['mobile']);
                $viewDatas['mobiles'] = $mobiles;
                $viewDatas['donnees']['mobile'] = $datas['mobile'];
                break;
            case 'statsChutes' :
                $chutes = [];
                array_shift($datas['saturation_chute']);
                $chutes['defauts'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['saturation_chute'], 'saturation_chute', 'saturation_chute');
                $chutes['commentaires'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['saturation_chute'], 'commentaires', 'saturation_chute');
                $viewDatas['chutes'] = $chutes;
                $viewDatas['donnees']['saturation_chute'] = $datas['saturation_chute'];
                break;
            case 'statsConvoyeurs' :
                $convoyeurs = [];
                array_shift($datas['numero_convoyeur']);
                $convoyeurs['defauts'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['numero_convoyeur'], 'numero_convoyeur', 'numero_convoyeur');
                $convoyeurs['symptomes'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['numero_convoyeur'], 'symptome', 'numero_convoyeur');
                $convoyeurs['commentaires'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['numero_convoyeur'], 'commentaires', 'numero_convoyeur');
                $viewDatas['convoyeurs'] = $convoyeurs;
                $viewDatas['donnees']['numero_convoyeur'] = $datas['numero_convoyeur'];
                break;
            case 'statsCantons' :
                $cantons = [];
                array_shift($datas['numero_canton']);
                $cantons['defauts'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['numero_canton'], 'numero_canton', 'numero_canton');
                $cantons['symptomes'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['numero_canton'], 'symptome', 'numero_canton');
                $cantons['commentaires'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['numero_canton'], 'commentaires', 'numero_canton');
                $cantons['mobiles'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['numero_canton'], 'mobile', 'numero_canton');
                $viewDatas['cantons'] = $cantons;
                $viewDatas['donnees']['numero_canton'] = $datas['numero_canton'];
                break;
            case 'statsNouveauxDefauts' :
                $newDefauts = [];
                $newDefauts['defauts'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['cause'], 'cause', 'cause');
                $newDefauts['commentaires'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['cause'], 'commentaires', 'cause');
                $viewDatas['nouveauxDefauts'] = $newDefauts;
                $viewDatas['donnees'] = $datas;
                break;

            case 'statsBanques' :
                $banques = [];
                $device = ['Dépose', 'Injecteur', 'Banque'];

                for ($i = 1; $i < 18; $i++) {
                    $banques[$i] = [
                        'Dépose' => 'I_BQ_' . str_pad($i, 2, "0", STR_PAD_LEFT) . '_DEF_RC_DEP',
                        'Injecteur' => 'I_BQ_' . str_pad($i, 2, "0", STR_PAD_LEFT) . '_DEF_RC_INJ'
                    ];
                }
                $defautsBanques = $this->getDefautsByMonth($banques, $device);

                $viewDatas['banques'] = $defautsBanques;
                break;

            case 'statsMobilesLogs' :
                $device = ['mobile', 'mobile', 'mobile'];
                $mobiles = [];
                for ($i = 1; $i < 37; $i++) {
                    $mobiles[$i] = [
                        'mobile' => 'DT410_D_MT_' . $i
                    ];
                }

                $defautsMobiles = $this->getDefautsByMonth($mobiles, $device);
                $viewDatas['mobiles'] = $defautsMobiles;
                break;

            case 'statsMobilesLogsDays' :
                $device = ['mobile', 'mobile', 'mobile'];
                $mobiles = [];
                for ($i = 1; $i < 37; $i++) {
                    $mobiles[$i] = [
                        'mobile' => 'DT410_D_MT_' . $i
                    ];
                }

                $defautsMobiles = $this->getDefautsByDays($mobiles, $device, $startDate, $endDate);
                $viewDatas['mobiles'] = $defautsMobiles;
                break;

            case 'statsChutesLogs' :

                $device = ['chute', 'chute', 'chute'];
                $chutes = [
                    0 => ['chute' => 'SATURATION_CHUTE_HG'],
                    1 => ['chute' => 'SATURATION_CHUTE_R']
                ];
                for ($i = 2; $i < 18; $i++) {
                    $chutes[$i] = [
                        'chute' => 'SATURATION_CHUTE_' . chr($i + 63)
                    ];
                }
                $defautsChutes = $this->getDefautsByMonth($chutes, $device);
                $viewDatas['chutes'] = $defautsChutes;
                break;

            case 'statsNouveauxDefautsLogs' :
                $device = ['new', 'new', 'new'];
                $news = [
                    0 => ['new' => 'DEF_INCENDIE'],
                    1 => ['new' => 'PILE_MEMOIRE'],
                    2 => ['new' => 'DEF_API'],
                    3 => ['new' => 'DEFAUT_MOD2'],
                    4 => ['new' => 'DEFAUT_MOD4'],
                    5 => ['new' => 'DEFAUT_MOD5'],
                    6 => ['new' => 'DEFAUT_MOD6'],
                    7 => ['new' => 'CTX_OK'],

                ];

                $defautsNews = $this->getDefautsByMonth($news, $device);
                $viewDatas['news'] = $defautsNews;
                break;

            case 'statsConvoyeursTRA100' :
                $device = ['new', 'new', 'new'];
                $news = [
                    0 => ['new' => 'PAUSE_TRA100'],
                    1 => ['new' => 'I_DEF_DISC_CONT_DEC_TRA100'],
                    2 => ['new' => 'I_DEF_ARRET_TAPIS_TRA100'],
                    3 => ['new' => 'I_DEF_BAG_COINCE_TRA100'],
                    4 => ['new' => 'I_DEF_DISC_CONT_ENCL_TRA100'],
                    5 => ['new' => 'I_DEF_ROT_TAPIS_TRA100'],
                    6 => ['new' => 'I_DEF_SECTIONNEUR_TRA100'],
                ];

                $defautsNews = $this->getDefautsByMonth($news, $device);
                $viewDatas['news'] = $defautsNews;
                break;

            case 'statsConvoyeursTRA110' :
                $device = ['new', 'new', 'new'];
                $news = [
                    0 => ['new' => 'PAUSE_TRA110'],
                    1 => ['new' => 'I_DEF_DISC_CONT_DEC_TRA110'],
                    2 => ['new' => 'I_DEF_ARRET_TAPIS_TRA110'],
                    3 => ['new' => 'I_DEF_BAG_COINCE_TRA110'],
                    4 => ['new' => 'I_DEF_DISC_CONT_ENCL_TRA110'],
                    5 => ['new' => 'I_DEF_ROT_TAPIS_TRA110'],
                    6 => ['new' => 'I_DEF_SECTIONNEUR_TRA110'],
                ];

                $defautsNews = $this->getDefautsByMonth($news, $device);
                $viewDatas['news'] = $defautsNews;
                break;

            case 'statsCantonsLogs' :
                $device = ['new', 'new', 'new'];
                $news = [
                    0 => ['new' => 'I_DEF_ALARM_CC101'],
                    1 => ['new' => 'I_DEF_ALARM_CC102'],
                    2 => ['new' => 'I_DEF_ALARM_CC105'],
                    3 => ['new' => 'I_DEF_ALARM_CC106'],
                    4 => ['new' => 'I_DEF_ALARM_CC107'],
                    5 => ['new' => 'I_DEF_ALARM_CC108'],
                    6 => ['new' => 'I_DEF_ALARM_CC109'],
                    7 => ['new' => 'I_DEF_ALARM_CC110'],
                    8 => ['new' => 'I_DEF_ALARM_CC115'],
                    9 => ['new' => 'I_DEF_ALARM_CC116'],
                    10 => ['new' => 'I_DEF_ALARM_CC117'],
                    11 => ['new' => 'I_DEF_ALARM_CC118'],
                    12 => ['new' => 'I_DEF_ALARM_CC120'],
                    13 => ['new' => 'I_DEF_ALARM_CC121'],
                    14 => ['new' => 'I_DEF_ALARM_CC122'],
                    15 => ['new' => 'I_DEF_ALARM_CC123'],
                    16 => ['new' => 'I_DEF_ALARM_CC220'],
                    17 => ['new' => 'I_DEF_ALARM_CC221'],
                    18 => ['new' => 'I_DEF_ALARM_CC222'],
                    19 => ['new' => 'I_DEF_ALARM_CC223'],
                    20 => ['new' => 'I_DEF_ALARM_CC224'],
                    21 => ['new' => 'I_DEF_ALARM_CC225'],
                    22 => ['new' => 'I_DEF_ALARM_CC226'],
                    23 => ['new' => 'I_DEF_ALARM_CC227'],
                    24 => ['new' => 'I_DEF_ALARM_CC230'],
                    25 => ['new' => 'I_DEF_ALARM_CC232'],
                    26 => ['new' => 'I_DEF_ALARM_CC233'],
                    27 => ['new' => 'I_DEF_ALARM_CC234'],
                    28 => ['new' => 'I_DEF_ALARM_CC235'],
                    29 => ['new' => 'I_DEF_ALARM_CC236'],
                    30 => ['new' => 'I_DEF_ALARM_CC237'],
                    31 => ['new' => 'I_DEF_ALARM_CC238'],
                    32 => ['new' => 'I_DEF_ALARM_CC240'],
                    33 => ['new' => 'I_DEF_ALARM_CC241'],
                    34 => ['new' => 'I_DEF_ALARM_CC242'],
                    35 => ['new' => 'I_DEF_ALARM_CC243'],
                    36 => ['new' => 'I_DEF_ALARM_CC244'],
                    37 => ['new' => 'I_DEF_ALARM_CC245'],
                    38 => ['new' => 'I_DEF_ALARM_CC249'],
                    39 => ['new' => 'I_DEF_ALARM_CC250'],
                    40 => ['new' => 'I_DEF_ALARM_CC251'],
                    41 => ['new' => 'I_DEF_ALARM_CC252'],
                    42 => ['new' => 'I_DEF_ALARM_CC253'],
                    43 => ['new' => 'I_DEF_ALARM_CC254'],
                ];

                $defautsNews = $this->getDefautsByMonth($news, $device);
                $viewDatas['news'] = $defautsNews;
                break;

            case 'statsAiguillagesLogs' :
                $device = ['new', 'new', 'new'];
                $news = [
                    0 => ['new' => 'I_DEF_AIG_CC120'],
                    1 => ['new' => 'I_DEF_AIG_CC220'],
                    2 => ['new' => 'I_DEF_AIG_CC234'],
                    3 => ['new' => 'I_DEF_AIG_CC241'],
                ];

                $defautsNews = $this->getDefautsByMonth($news, $device);
                $viewDatas['news'] = $defautsNews;
                break;

            case 'statsByHours' :
                $device = ['new', 'new', 'new'];
                $news = [
                    0 => ['new' => 'PAUSE_TRA100'],
                    1 => ['new' => 'PAUSE_TRA110'],
                    2 => ['new' => 'I_DEF_BAG_COINCE_TRA100'],
                    3 => ['new' => 'I_DEF_BAG_COINCE_TRA110'],
                ];

                $defautsNews = $this->getDefautsByHours($news, $device, $startDate, $endDate);
                $viewDatas['news'] = $defautsNews;
                break;

            default :
                $materiel = 'errors/404';
        }
        return view($materiel)->with($viewDatas);
    }


    private function getDefautsByMonth($devices, $device)
    {
        $tableDefauts = [];
        if ($devices) {
            foreach ($devices as $key => $value) {
                $tableDefauts[$key] = DefautsAutomate::getDefautsByMonth(
                    $value[$device[0]], $value[$device[1]]);
                $tableDefauts[$key] += [$device[2] => $key];
            }
        }
        return $tableDefauts;
    }

    private function getDefautsByDays($devices, $device, $startDate, $endDate)
    {
        $tableDefauts = [];
        if ($devices) {
            foreach ($devices as $key => $value) {
                $tableDefauts[$key] = DefautsAutomate::getDefautsByDays(
                    $value[$device[0]], $value[$device[1]], $startDate, $endDate);
                $tableDefauts[$key] += [$device[2] => $key];
            }
        }
        return $tableDefauts;
    }

    private function getDefautsByHours($devices, $device, $startDate, $endDate)
    {
        $tableDefauts = [];
        if ($devices) {
            foreach ($devices as $key => $value) {
                $tableDefauts[$key] = DefautsAutomate::getDefautsByHours(
                    $value[$device[0]], $value[$device[1]], $startDate, $endDate);
                $tableDefauts[$key] += [$device[2] => $key];
            }
        }
        return $tableDefauts;
    }

    static function getDefautsMobiles($startDate, $endDate)
    {
        $datas = Data_operateur::getNumberOfProblemByDevice($startDate, $endDate, array('mobile'));
        $mobiles = [];
        array_shift($datas['mobile']);
        $mobiles['defauts'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['mobile'], 'symptome', 'mobile');
        $mobiles['cantons'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['mobile'], 'numero_canton', 'mobile');
        $mobiles['commentaires'] = Data_operateur::getNumberOfTypeProblemByDevice($startDate, $endDate, $datas['mobile'], 'commentaires', 'mobile');

        return $mobiles;
    }

}