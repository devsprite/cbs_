<?php

namespace cbs\Http\Controllers;

use cbs\Data_operateur;
use cbs\DefautsAutomate;
use cbs\Stats_bagage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use PhpSpec\Exception\Exception;

class ImportController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Fonction appelé après POST du fichier, fait la redirection en fonction du fichier.
     *
     * @return mixed
     */
    public function importFile()
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

        $pathFileSuiviCBS = $path . 'Suivi_CBS_Base.xls';
        $pathFileStatsCBS = $path . 'Stat_Tri_CBS.xlsm';

        $directoryFiles = scandir($path);
        $directoryFiles = array_splice($directoryFiles, 2);

        if (count($directoryFiles) == 0) {
            return redirect()->route('form_upload')->with('error', 'Erreur : Aucun fichier trouvé !');

        } elseif (file_exists($pathFileSuiviCBS)) {
            return $this->importSuiviCBSBase();

        } elseif (file_exists($pathFileStatsCBS)) {
            return $this->importStatCBS();

        } elseif (is_file($path . $directoryFiles[0])) {
            $infoFile = pathinfo($path . $directoryFiles[0]);
            if ($infoFile['extension'] == 'ALM') {
                return $this->importFileALM($directoryFiles);
            }
        } else {
            $this->deleteFiles();
            return redirect()->route('form_upload')->with('error', 'Erreur : Ce type de fichier n\'est pas supporté');
        }
    }


    /**
     * Import du fichier Suivi_CBS_Base.xls
     */
    public function importSuiviCBSBase()
    {
        $pathFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/Suivi_CBS_Base.xls';

        if (!file_exists($pathFile)) {
            return Redirect::route('form_upload')->with('error', 'Erreur : ' . $pathFile . ' Le fichier n\'existe pas !');
        }
        try {
            set_time_limit(600);
            $datas = Excel::selectSheetsByIndex(0)->load($pathFile, function ($reader) {
                $reader->formatDates(true, 'Y-m-d H:i:s');
            })->get();

            foreach ($datas as $data) {

                $data->numero_du_mobile = $this->modifNumeroMobile($data->numero_du_mobile);

                $dataOperateurs = Data_operateur::firstOrNew([
                    'date' => substr($data->date, 0, 10),
                    'heure_de_debut' => substr($data->date, 0, 10) . substr($data->heure_de_debut, 10, 10),
                    'duree' => substr($data->date, 0, 10) . substr($data->duree, 10, 10),
                    'nombre_agent' => substr((String)$data->nombre_dagent, 0, 4),
                    'intervenant' => $data->intervenant,
                    'mobile' => $data->numero_du_mobile,
                    'numero_canton' => $data->numero_du_canton,
                    'numero_convoyeur' => $data->numero_du_convoyeur,
                    'defaut_eds' => $data->defaut_eds,
                    'defaut_tomographe' => $data->defaut_tomographe,
                    'saturation_chute' => $data->saturation_chute,
                    'cause' => $data->cause,
                    'mode_de_defaillance' => $data->mode_de_defaillance,
                    'symptome' => $data->symptome,
                    'commentaires' => $data->commentaires
                ]);

                $isExist = Data_operateur::where('heure_de_debut', '=', substr($data->date, 0, 10) . substr($data->heure_de_debut, 10, 10))->first();

                if (is_null($isExist)) {
                    $dataOperateurs->save();
                }
            }

            $this->deleteFiles();

        } catch (Exception $e) {
            Log::info('Erreur ' . $e->getMessage());
            return Redirect::route('form_upload')->with('error', 'Erreur : ' . $e->getMessage());
        }

        return Redirect::route('home')->with('success', 'Mise à jour réussi !');
    }


    /**
     * Import du fichier Stat_Tri_CBS.xls
     */
    private function importStatCBS()
    {
        $pathFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/Stat_Tri_CBS.xlsm';

        if (!file_exists($pathFile)) {
            return Redirect::route('form_upload')->with('error', 'Erreur : ' . $pathFile . ' Le fichier n\'existe pas !');
        }
        try {
            set_time_limit(600);
            $datas = Excel::selectSheetsByIndex(0)->load($pathFile, function ($reader) {
                $reader->formatDates(true, 'Y-m-d');
            })->get();

            foreach ($datas as $data) {
                $stat = Stats_bagage::firstOrNew([
                    'date' => $data->date,
                    'nombre_de_bagages_acceptes_niveau_1_par_eds01' => $data->nombre_de_bagages_acceptes_niveau_1_par_eds01,
                    'nombre_de_bagages_acceptes_niveau_2_par_operateur_eds01' => $data->nombre_de_bagages_acceptes_niveau_2_par_operateur_eds01,
                    'nombre_de_bagages_acceptes_par_le_tomographe_ou_loperateur' => $data->nombre_de_bagages_acceptes_par_le_tomographe_ou_loperateur,
                    'nombre_de_bagages_injectes_depuis_la_ligne_correspondance' => $data->nombre_de_bagages_injectes_depuis_la_ligne_correspondance,
                    'nombre_de_bagages_envoyes_au_local_fouille' => $data->nombre_de_bagages_envoyes_au_local_fouille,
                    'nombre_de_bagages_injectes_depuis_la_ligne_hors_gabarit' => $data->nombre_de_bagages_injectes_depuis_la_ligne_hors_gabarit,
                    'nombre_de_bagages_declares_inconnu_par_le_tomographe' => $data->nombre_de_bagages_declares_inconnu_par_le_tomographe,
                    'nombre_de_bagages_inspecte_par_eds01' => $data->nombre_de_bagages_inspecte_par_eds01,
                    'nombre_de_bagages_inspectes_par_le_tomographe' => $data->nombre_de_bagages_inspectes_par_le_tomographe,
                    'nombre_de_bagages_injectes_par_la_ligne_1' => $data->nombre_de_bagages_injectes_par_la_ligne_1,
                    'nombre_de_bagages_injectes_par_la_ligne_2' => $data->nombre_de_bagages_injectes_par_la_ligne_2,
                    'nombre_de_bagages_envoyes_vers_chute_hors_gabarit' => $data->nombre_de_bagages_envoyes_vers_chute_hors_gabarit,
                    'nombre_de_bagages_envoyes_vers_le_tomographe_par_la_fonction_s' => $data->nombre_de_bagages_envoyes_vers_le_tomographe_par_la_fonction_s,
                    'nombre_de_bagages_sans_decision_niveau_1_par_eds01' => $data->nombre_de_bagages_sans_decision_niveau_1_par_eds01,
                    'nombre_de_bagages_sans_decision_niveau_2_par_operateur_eds01' => $data->nombre_de_bagages_sans_decision_niveau_2_par_operateur_eds01,
                    'nombre_de_bagages_rejetes_niveau_1_par_eds01' => $data->nombre_de_bagages_rejetes_niveau_1_par_eds01,
                    'nombre_de_bagages_rejetes_niveau_2_par_operateur_eds01' => $data->nombre_de_bagages_rejetes_niveau_2_par_operateur_eds01,
                    'nombre_de_bagages_rejetes_par_le_tomographe_ou_loperateur' => $data->nombre_de_bagages_rejetes_par_le_tomographe_ou_loperateur,
                    'nombre_de_bagages_envoyes_vers_tomographe_par_suite_a_un_reje' => $data->nombre_de_bagages_envoyes_vers_tomographe_par_suite_a_un_reje,
                    'nombre_de_bagages_envoyes_vers_fouille_suite_a_un_rejet_techn' => $data->nombre_de_bagages_envoyes_vers_fouille_suite_a_un_rejet_techn,
                    'nombre_de_bagages_envoyes_vers_tomographe_par_saturation_aval' => $data->nombre_de_bagages_envoyes_vers_tomographe_par_saturation_aval,
                    'nombre_de_bagages_en_mode_degrade' => $data->nombre_de_bagages_en_mode_degrade,
                    'temps_de_fonctionnement_en_mode_nominal_surete_en_mn' => $data->temps_de_fonctionnement_en_mode_nominal_surete_en_mn,
                    'temps_de_fonctionnement_en_mode_degrade_eds01_en_mn' => $data->temps_de_fonctionnement_en_mode_degrade_eds01_en_mn,
                    'temps_de_fonctionnement_en_mode_degrade_tomo_en_mn' => $data->temps_de_fonctionnement_en_mode_degrade_tomo_en_mn,
                    'nombre_de_bagages_envoyes_vers_chute_rejet' => $data->nombre_de_bagages_envoyes_vers_chute_rejet,
                    'abscence_de_reponse_bag_2000_c_bq01_com' => $data->abscence_de_reponse_bag_2000_c_bq01_com,
                    'abscence_de_reponse_bag_2000_c_bq02_com' => $data->abscence_de_reponse_bag_2000_c_bq02_com,
                    'abscence_de_reponse_bag_2000_c_bq03_com' => $data->abscence_de_reponse_bag_2000_c_bq03_com,
                    'abscence_de_reponse_bag_2000_c_bq04_com' => $data->abscence_de_reponse_bag_2000_c_bq04_com,
                    'abscence_de_reponse_bag_2000_c_bq05_com' => $data->abscence_de_reponse_bag_2000_c_bq05_com,
                    'abscence_de_reponse_bag_2000_c_bq06_com' => $data->abscence_de_reponse_bag_2000_c_bq06_com,
                    'abscence_de_reponse_bag_2000_c_bq07_com' => $data->abscence_de_reponse_bag_2000_c_bq07_com,
                    'abscence_de_reponse_bag_2000_c_bq08_com' => $data->abscence_de_reponse_bag_2000_c_bq08_com,
                    'abscence_de_reponse_bag_2000_c_bq09_com' => $data->abscence_de_reponse_bag_2000_c_bq09_com,
                    'abscence_de_reponse_bag_2000_c_bq10_com' => $data->abscence_de_reponse_bag_2000_c_bq10_com,
                    'abscence_de_reponse_bag_2000_c_bq11_com' => $data->abscence_de_reponse_bag_2000_c_bq11_com,
                    'abscence_de_reponse_bag_2000_c_bq12_com' => $data->abscence_de_reponse_bag_2000_c_bq12_com,
                    'abscence_de_reponse_bag_2000_c_bq14_com' => $data->abscence_de_reponse_bag_2000_c_bq14_com,
                    'abscence_de_reponse_bag_2000_c_bq15_com' => $data->abscence_de_reponse_bag_2000_c_bq15_com,
                    'abscence_de_reponse_bag_2000_c_bq16_com' => $data->abscence_de_reponse_bag_2000_c_bq16_com,
                    'abscence_de_reponse_bag_2000_c_bq17_com' => $data->abscence_de_reponse_bag_2000_c_bq17_com,
                    'abscence_de_reponse_bag_2000_ligne_correspondance' => $data->abscence_de_reponse_bag_2000_ligne_correspondance,
                    'abscence_de_reponse_bag_2000_ligne_hors_gabarit' => $data->abscence_de_reponse_bag_2000_ligne_hors_gabarit,
                    'abscence_de_reponse_bag_2000_local_de_fouille' => $data->abscence_de_reponse_bag_2000_local_de_fouille,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_local_de_foui' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_local_de_foui,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_hors_gab' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_hors_gab,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_corresp' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_corresp,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq17_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq17_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq16_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq16_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq15_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq15_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq14_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq14_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq12_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq12_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq11_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq11_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq10_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq10_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq09_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq09_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq08_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq08_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq07_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq07_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq06_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq06_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq05_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq05_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq04_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq04_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq03_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq03_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq02_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq02_r,
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq01_r' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq01_r,
                    // Perte de tri ligne 1
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri_l' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri_l,
                    // perte de tri ligne 2
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri,
                    // perte de tri installation
                    'envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de' => $data->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de,
                    'err_ecriture_bd101' => $data->err_ecriture_bd101,
                    'err_ecriture_bd105' => $data->err_ecriture_bd105,
                    'ecriture_bd106' => $data->ecriture_bd106,
                    'ecriture_bd121' => $data->ecriture_bd121,
                    'ecriture_bd125' => $data->ecriture_bd125,
                    'ecriture_bd127' => $data->ecriture_bd127,
                    'ecriture_bd130' => $data->ecriture_bd130,
                    'ecriture_bd134' => $data->ecriture_bd134,
                    'ecriture_bd140' => $data->ecriture_bd140,
                    'ecriture_bd144' => $data->ecriture_bd144,
                    'err_ecriture_bd106' => $data->err_ecriture_bd106,
                    'err_ecriture_bd121' => $data->err_ecriture_bd121,
                    'err_ecriture_bd123' => $data->err_ecriture_bd123,
                    'err_ecriture_bd125' => $data->err_ecriture_bd125,
                    'err_ecriture_bd127' => $data->err_ecriture_bd127,
                    'err_ecriture_bd130' => $data->err_ecriture_bd130,
                    'err_ecriture_bd134' => $data->err_ecriture_bd134,
                    'err_ecriture_bd140' => $data->err_ecriture_bd140,
                    'err_ecriture_bd144' => $data->err_ecriture_bd144,
                    'err_lecture_bd101' => $data->err_lecture_bd101,
                    'err_lecture_bd105' => $data->err_lecture_bd105,
                    'err_lecture_bd106' => $data->err_lecture_bd106,
                    'err_lecture_bd121' => $data->err_lecture_bd121,
                    'err_lecture_bd123' => $data->err_lecture_bd123,
                    'err_lecture_bd125' => $data->err_lecture_bd125,
                    'err_lecture_bd127' => $data->err_lecture_bd127,
                    'err_lecture_bd130' => $data->err_lecture_bd130,
                    'err_lecture_bd134' => $data->err_lecture_bd134,
                    'err_lecture_bd140' => $data->err_lecture_bd140,
                    'err_lecture_bd144' => $data->err_lecture_bd144,
                    'lecture_bd101' => $data->lecture_bd101,
                    'lecture_bd105' => $data->lecture_bd105,
                    'lecture_bd106' => $data->lecture_bd106,
                    'lecture_bd121' => $data->lecture_bd121,
                    'lecture_bd125' => $data->lecture_bd125,
                    'lecture_bd127' => $data->lecture_bd127,
                    'lecture_bd130' => $data->lecture_bd130,
                    'lecture_bd134' => $data->lecture_bd134,
                    'lecture_bd135' => $data->lecture_bd135,
                    'lecture_bd140' => $data->lecture_bd140,
                    'lecture_bd144' => $data->lecture_bd144,
                    'lecture_bd153' => $data->lecture_bd153,
                    'lecture_bd234' => $data->lecture_bd234,
                    'err_lecture_bd234' => $data->err_lecture_bd234,
                    'err_lecture_bd135' => $data->err_lecture_bd135,
                    'err_lecture_bd153' => $data->err_lecture_bd153,
                ]);

                $exist = Stats_bagage::where('date', '=', $stat->date)->first();

                if (is_null($exist)) {
                    $stat->save();
                }

                unset($stat);
            }
            $this->deleteFiles();

        } catch (Exception $e) {
            Log::info('Erreur ' . $e->getMessage());
            return Redirect::route('form_upload')->with('error', 'Erreur : ' . $e->getMessage());
        }
        return Redirect::route('home')->with('success', 'Mise à jour réussi !');
    }

    /**
     *
     * Modification du numero de mobile de 1 en 01, 2 en 02 etc
     *
     * @param $data
     * @return mixed
     */
    public static function modifNumeroMobile($data)
    {
        $patterns = [
            '0' => '/ 1$/',
            '1' => '/ 2$/',
            '2' => '/ 3$/',
            '3' => '/ 4$/',
            '4' => '/ 5$/',
            '5' => '/ 6$/',
            '6' => '/ 7$/',
            '7' => '/ 8$/',
            '8' => '/ 9$/'
        ];

        $replacements = [
            '0' => ' 01',
            '1' => ' 02',
            '2' => ' 03',
            '3' => ' 04',
            '4' => ' 05',
            '5' => ' 06',
            '6' => ' 07',
            '7' => ' 08',
            '8' => ' 09'
        ];

        $data = preg_replace($patterns, $replacements, $data);

        return $data;
    }


    /**
     * Import des fichiers ALM
     *
     * @param $directoryFiles
     */
    private static function importFileALM($directoryFiles)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        try {
            set_time_limit(600);
            foreach ($directoryFiles as $df) {

                if (($handle = fopen($path . $df, "r")) !== FALSE) {
                    while (($data = fgets($handle)) !== FALSE) {
                        echo "<br />";
                        ImportController::importLineALM(utf8_encode($data));
                    }
                    fclose($handle);
                }
            }

            ImportController::deleteFiles();
            return Redirect::route('home')->with('success', 'Mise à jour réussi !');
        } catch (Exception $e) {
            Log::info('Erreur ' . $e->getMessage());
            return Redirect::route('form_upload')->with('error', 'Erreur : ' . $e->getMessage());
        }

    }

    /**
     *
     * import des lignes des fichiers ALM
     *
     * @param $data
     */
    private static function importLineALM($data)
    {

        // Extraction de date et time du defaut
        $dateLine = substr($data, 6, 4) . '-' . substr($data, 3, 2) . '-' . substr($data, 0, 2);

        $timeLine = substr($data, 11, 8);

        // On récupère la chaine qui représente le defaut
        $defaut = substr($data, 33, 1000);

        // On découpe la chaine en tableau
        $tab_defaut = preg_split("/[\s]+/", $defaut);

        // On reconstitue la description du defaut
        $description_defaut = implode(" ", array_slice($tab_defaut, 3));

        $defautAutomate = DefautsAutomate::firstOrNew([
            'date' => $dateLine,
            'time' => $timeLine,
            'defaut' => $tab_defaut[0],
            'etat_1' => $tab_defaut[1],
            'etat_2' => $tab_defaut[2],
            'description' => $description_defaut
        ]);

        // On enregistre uniquement les defauts
        if ($defautAutomate->etat_1 == "OK" || $defautAutomate->etat_1 == "CFN" || $defautAutomate->etat_1 == "COS") {
            $defautAutomate->save();
        }
    }


    /**
     * Efface les fichiers qui se trouvent dans le répertoire /upload
     *
     * @param $directoryFiles
     */
    public static function deleteFiles()
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        $directoryFiles = scandir($path);

        foreach ($directoryFiles as $df) {
            if (is_file($path . $df)) {
                unlink($path . $df);
            }
        }
    }

}