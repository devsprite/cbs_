<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsBagagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_bagages', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('nombre_de_bagages_acceptes_niveau_1_par_eds01')->nullable();
            $table->integer('nombre_de_bagages_acceptes_niveau_2_par_operateur_eds01')->nullable();
            $table->integer('nombre_de_bagages_acceptes_par_le_tomographe_ou_loperateur')->nullable();
            $table->integer('nombre_de_bagages_injectes_depuis_la_ligne_correspondance')->nullable();
            $table->integer('nombre_de_bagages_envoyes_au_local_fouille')->nullable();
            $table->integer('nombre_de_bagages_injectes_depuis_la_ligne_hors_gabarit')->nullable();
            $table->integer('nombre_de_bagages_declares_inconnu_par_le_tomographe')->nullable();
            $table->integer('nombre_de_bagages_inspecte_par_eds01')->nullable();
            $table->integer('nombre_de_bagages_inspectes_par_le_tomographe')->nullable();
            $table->integer('nombre_de_bagages_injectes_par_la_ligne_1')->nullable();
            $table->integer('nombre_de_bagages_injectes_par_la_ligne_2')->nullable();
            $table->integer('nombre_de_bagages_envoyes_vers_chute_hors_gabarit')->nullable();
            $table->integer('nombre_de_bagages_envoyes_vers_le_tomographe_par_la_fonction_s')->nullable();
            $table->integer('nombre_de_bagages_sans_decision_niveau_1_par_eds01')->nullable();
            $table->integer('nombre_de_bagages_sans_decision_niveau_2_par_operateur_eds01')->nullable();
            $table->integer('nombre_de_bagages_rejetes_niveau_1_par_eds01')->nullable();
            $table->integer('nombre_de_bagages_rejetes_niveau_2_par_operateur_eds01')->nullable();
            $table->integer('nombre_de_bagages_rejetes_par_le_tomographe_ou_loperateur')->nullable();
            $table->integer('nombre_de_bagages_envoyes_vers_tomographe_par_suite_a_un_reje')->nullable();
            $table->integer('nombre_de_bagages_envoyes_vers_fouille_suite_a_un_rejet_techn')->nullable();
            $table->integer('nombre_de_bagages_envoyes_vers_tomographe_par_saturation_aval')->nullable();
            $table->integer('nombre_de_bagages_en_mode_degrade')->nullable();
            $table->integer('temps_de_fonctionnement_en_mode_nominal_surete_en_mn')->nullable();
            $table->integer('temps_de_fonctionnement_en_mode_degrade_eds01_en_mn')->nullable();
            $table->integer('temps_de_fonctionnement_en_mode_degrade_tomo_en_mn')->nullable();
            $table->integer('nombre_de_bagages_envoyes_vers_chute_rejet')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq01_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq02_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq03_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq04_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq05_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq06_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq07_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq08_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq09_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq10_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq11_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq12_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq14_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq15_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq16_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_c_bq17_com')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_ligne_correspondance')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_ligne_hors_gabarit')->nullable();
            $table->integer('abscence_de_reponse_bag_2000_local_de_fouille')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_local_de_foui')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_hors_gab')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_corresp')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq17_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq16_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq15_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq14_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq12_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq11_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq10_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq09_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq08_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq07_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq06_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq05_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq04_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq03_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq02_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq01_r')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri_l')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri')->nullable();
            $table->integer('envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de')->nullable();
            $table->integer('err_ecriture_bd101')->nullable();
            $table->integer('err_ecriture_bd105')->nullable();
            $table->integer('ecriture_bd106')->nullable();
            $table->integer('ecriture_bd121')->nullable();
            $table->integer('ecriture_bd125')->nullable();
            $table->integer('ecriture_bd127')->nullable();
            $table->integer('ecriture_bd130')->nullable();
            $table->integer('ecriture_bd134')->nullable();
            $table->integer('ecriture_bd140')->nullable();
            $table->integer('ecriture_bd144')->nullable();
            $table->integer('err_ecriture_bd106')->nullable();
            $table->integer('err_ecriture_bd121')->nullable();
            $table->integer('err_ecriture_bd123')->nullable();
            $table->integer('err_ecriture_bd125')->nullable();
            $table->integer('err_ecriture_bd127')->nullable();
            $table->integer('err_ecriture_bd130')->nullable();
            $table->integer('err_ecriture_bd134')->nullable();
            $table->integer('err_ecriture_bd140')->nullable();
            $table->integer('err_ecriture_bd144')->nullable();
            $table->integer('err_lecture_bd101')->nullable();
            $table->integer('err_lecture_bd105')->nullable();
            $table->integer('err_lecture_bd106')->nullable();
            $table->integer('err_lecture_bd121')->nullable();
            $table->integer('err_lecture_bd123')->nullable();
            $table->integer('err_lecture_bd125')->nullable();
            $table->integer('err_lecture_bd127')->nullable();
            $table->integer('err_lecture_bd130')->nullable();
            $table->integer('err_lecture_bd134')->nullable();
            $table->integer('err_lecture_bd140')->nullable();
            $table->integer('err_lecture_bd144')->nullable();
            $table->integer('lecture_bd101')->nullable();
            $table->integer('lecture_bd105')->nullable();
            $table->integer('lecture_bd106')->nullable();
            $table->integer('lecture_bd121')->nullable();
            $table->integer('lecture_bd125')->nullable();
            $table->integer('lecture_bd127')->nullable();
            $table->integer('lecture_bd130')->nullable();
            $table->integer('lecture_bd134')->nullable();
            $table->integer('lecture_bd135')->nullable();
            $table->integer('lecture_bd140')->nullable();
            $table->integer('lecture_bd144')->nullable();
            $table->integer('lecture_bd153')->nullable();
            $table->integer('lecture_bd234')->nullable();
            $table->integer('err_lecture_bd234')->nullable();
            $table->integer('err_lecture_bd135')->nullable();
            $table->integer('err_lecture_bd153')->nullable();
            $table->boolean('valid')->default(1);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stats_bagages');
    }
}
