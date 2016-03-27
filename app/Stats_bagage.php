<?php

namespace cbs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stats_bagage extends Model
{
    protected $fillable = [
        'date',
        'nombre_de_bagages_acceptes_niveau_1_par_eds01',
        'nombre_de_bagages_acceptes_niveau_2_par_operateur_eds01',
        'nombre_de_bagages_acceptes_par_le_tomographe_ou_loperateur',
        'nombre_de_bagages_injectes_depuis_la_ligne_correspondance',
        'nombre_de_bagages_envoyes_au_local_fouille',
        'nombre_de_bagages_injectes_depuis_la_ligne_hors_gabarit',
        'nombre_de_bagages_declares_inconnu_par_le_tomographe',
        'nombre_de_bagages_inspecte_par_eds01',
        'nombre_de_bagages_inspectes_par_le_tomographe',
        'nombre_de_bagages_injectes_par_la_ligne_1',
        'nombre_de_bagages_injectes_par_la_ligne_2',
        'nombre_de_bagages_envoyes_vers_chute_hors_gabarit',
        'nombre_de_bagages_envoyes_vers_le_tomographe_par_la_fonction_s',
        'nombre_de_bagages_sans_decision_niveau_1_par_eds01',
        'nombre_de_bagages_sans_decision_niveau_2_par_operateur_eds01',
        'nombre_de_bagages_rejetes_niveau_1_par_eds01',
        'nombre_de_bagages_rejetes_niveau_2_par_operateur_eds01',
        'nombre_de_bagages_rejetes_par_le_tomographe_ou_loperateur',
        'nombre_de_bagages_envoyes_vers_tomographe_par_suite_a_un_reje',
        'nombre_de_bagages_envoyes_vers_fouille_suite_a_un_rejet_techn',
        'nombre_de_bagages_envoyes_vers_tomographe_par_saturation_aval',
        'nombre_de_bagages_en_mode_degrade',
        'temps_de_fonctionnement_en_mode_nominal_surete_en_mn',
        'temps_de_fonctionnement_en_mode_degrade_eds01_en_mn',
        'temps_de_fonctionnement_en_mode_degrade_tomo_en_mn',
        'nombre_de_bagages_envoyes_vers_chute_rejet',
        'abscence_de_reponse_bag_2000_c_bq01_com',
        'abscence_de_reponse_bag_2000_c_bq02_com',
        'abscence_de_reponse_bag_2000_c_bq03_com',
        'abscence_de_reponse_bag_2000_c_bq04_com',
        'abscence_de_reponse_bag_2000_c_bq05_com',
        'abscence_de_reponse_bag_2000_c_bq06_com',
        'abscence_de_reponse_bag_2000_c_bq07_com',
        'abscence_de_reponse_bag_2000_c_bq08_com',
        'abscence_de_reponse_bag_2000_c_bq09_com',
        'abscence_de_reponse_bag_2000_c_bq10_com',
        'abscence_de_reponse_bag_2000_c_bq11_com',
        'abscence_de_reponse_bag_2000_c_bq12_com',
        'abscence_de_reponse_bag_2000_c_bq14_com',
        'abscence_de_reponse_bag_2000_c_bq15_com',
        'abscence_de_reponse_bag_2000_c_bq16_com',
        'abscence_de_reponse_bag_2000_c_bq17_com',
        'abscence_de_reponse_bag_2000_ligne_correspondance',
        'abscence_de_reponse_bag_2000_ligne_hors_gabarit',
        'abscence_de_reponse_bag_2000_local_de_fouille',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_local_de_foui',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_hors_gab',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_corresp',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq17_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq16_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq15_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq14_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq12_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq11_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq10_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq09_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq08_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq07_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq06_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq05_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq04_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq03_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq02_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq01_r',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri_l',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri',
        'envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de',
        'err_ecriture_bd101',
        'err_ecriture_bd105',
        'ecriture_bd106',
        'ecriture_bd121',
        'ecriture_bd125',
        'ecriture_bd127',
        'ecriture_bd130',
        'ecriture_bd134',
        'ecriture_bd140',
        'ecriture_bd144',
        'err_ecriture_bd106',
        'err_ecriture_bd121',
        'err_ecriture_bd123',
        'err_ecriture_bd125',
        'err_ecriture_bd127',
        'err_ecriture_bd130',
        'err_ecriture_bd134',
        'err_ecriture_bd140',
        'err_ecriture_bd144',
        'err_lecture_bd101',
        'err_lecture_bd105',
        'err_lecture_bd106',
        'err_lecture_bd121',
        'err_lecture_bd123',
        'err_lecture_bd125',
        'err_lecture_bd127',
        'err_lecture_bd130',
        'err_lecture_bd134',
        'err_lecture_bd140',
        'err_lecture_bd144',
        'lecture_bd101',
        'lecture_bd105',
        'lecture_bd106',
        'lecture_bd121',
        'lecture_bd125',
        'lecture_bd127',
        'lecture_bd130',
        'lecture_bd134',
        'lecture_bd135',
        'lecture_bd140',
        'lecture_bd144',
        'lecture_bd153',
        'lecture_bd234',
        'err_lecture_bd234',
        'err_lecture_bd135',
        'err_lecture_bd153',
        'valid'
    ];

    /**
     * @param String $startDate au format YYYY-mm-dd
     * @param String $endDate au format YYYY-mm-dd
     * @return retourne la liste des stats cbs correspondant à la période
     *
     */
    public static function getStatsBagages($startDate, $endDate)
    {
        $datas = DB::table('stats_bagages')
            ->select('*')
            ->where('valid', '=', '1')
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return $datas;
    }
    /**
     * @param String $startDate au format YYYY-mm-dd
     * @param String $endDate au format YYYY-mm-dd
     * @return Total bagages
     */
    public static function getTotalOfSomething($startDate, $endDate, $something)
    {
        $datas = DB::table('stats_bagages')
            ->select( DB::raw(' SUM(' .$something . ') as total, AVG('.$something.') as moyenne') )
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
        return $datas;
    }

    public static function lastDate()
    {
        $datas = DB::table('stats_bagages')
            ->select('date')
            ->orderBy('date', 'desc')
            ->first();

        return $datas;
    }
}
