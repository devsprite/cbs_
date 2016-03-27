@extends('main_page')

@section('title', 'Données Compteurs')

@section('content')
    <div class="right_col" role="main">
        @if( Session::has('error') )
            <div class="row alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if( Session::has('success') )
            <div class="row alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Base Stats</h3>
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Stats</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content row">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-center table-condensed">
                                    <caption>Base Stats</caption>
                                    <thead>
                                    <tr>
                                        @if(Auth::user()->email == 'greeftdc@gmail.com')
                                            <th>Edition</th>
                                        @endif
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;id&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>nombre_de_bagages_inspecte_par_eds01</th>
                                        <th>nombre_de_bagages_acceptes_niveau_1_par_eds01</th>
                                        <th>nombre_de_bagages_acceptes_niveau_2_par_operateur_eds01</th>
                                        <th>nombre_de_bagages_acceptes_par_le_tomographe_ou_loperateur</th>
                                        <th>nombre_de_bagages_injectes_depuis_la_ligne_correspondance</th>
                                        <th>nombre_de_bagages_envoyes_au_local_fouille</th>
                                        <th>nombre_de_bagages_injectes_depuis_la_ligne_hors_gabarit</th>
                                        <th>nombre_de_bagages_declares_inconnu_par_le_tomographe</th>
                                        <th>nombre_de_bagages_inspectes_par_le_tomographe</th>
                                        <th>nombre_de_bagages_injectes_par_la_ligne_1</th>
                                        <th>nombre_de_bagages_injectes_par_la_ligne_2</th>
                                        <th>nombre_de_bagages_envoyes_vers_chute_hors_gabarit</th>
                                        <th>nombre_de_bagages_envoyes_vers_le_tomographe_par_la_fonction_s</th>
                                        <th>nombre_de_bagages_sans_decision_niveau_1_par_eds01</th>
                                        <th>nombre_de_bagages_sans_decision_niveau_2_par_operateur_eds01</th>
                                        <th>nombre_de_bagages_rejetes_niveau_1_par_eds01</th>
                                        <th>nombre_de_bagages_rejetes_niveau_2_par_operateur_eds01</th>
                                        <th>nombre_de_bagages_rejetes_par_le_tomographe_ou_loperateur</th>
                                        <th>nombre_de_bagages_envoyes_vers_tomographe_par_suite_a_un_reje</th>
                                        <th>nombre_de_bagages_envoyes_vers_fouille_suite_a_un_rejet_techn</th>
                                        <th>nombre_de_bagages_envoyes_vers_tomographe_par_saturation_aval</th>
                                        <th>nombre_de_bagages_en_mode_degrade</th>
                                        <th>temps_de_fonctionnement_en_mode_nominal_surete_en_mn</th>
                                        <th>temps_de_fonctionnement_en_mode_degrade_eds01_en_mn</th>
                                        <th>temps_de_fonctionnement_en_mode_degrade_tomo_en_mn</th>
                                        <th>nombre_de_bagages_envoyes_vers_chute_rejet</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq01_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq02_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq03_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq04_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq05_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq06_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq07_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq08_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq09_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq10_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq11_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq12_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq14_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq15_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq16_com</th>
                                        <th>abscence_de_reponse_bag_2000_c_bq17_com</th>
                                        <th>abscence_de_reponse_bag_2000_ligne_correspondance</th>
                                        <th>abscence_de_reponse_bag_2000_ligne_hors_gabarit</th>
                                        <th>abscence_de_reponse_bag_2000_local_de_fouille</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_local_de_foui</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_hors_gab</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_corresp</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq17_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq16_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq15_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq14_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq12_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq11_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq10_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq09_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq08_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq07_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq06_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq05_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq04_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq03_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq02_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq01_r</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri_l</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri</th>
                                        <th>envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de</th>
                                        <th>err_ecriture_bd101</th>
                                        <th>err_ecriture_bd105</th>
                                        <th>ecriture_bd106</th>
                                        <th>ecriture_bd121</th>
                                        <th>ecriture_bd125</th>
                                        <th>ecriture_bd127</th>
                                        <th>ecriture_bd130</th>
                                        <th>ecriture_bd134</th>
                                        <th>ecriture_bd140</th>
                                        <th>ecriture_bd144</th>
                                        <th>err_ecriture_bd106</th>
                                        <th>err_ecriture_bd121</th>
                                        <th>err_ecriture_bd123</th>
                                        <th>err_ecriture_bd125</th>
                                        <th>err_ecriture_bd127</th>
                                        <th>err_ecriture_bd130</th>
                                        <th>err_ecriture_bd134</th>
                                        <th>err_ecriture_bd140</th>
                                        <th>err_ecriture_bd144</th>
                                        <th>err_lecture_bd101</th>
                                        <th>err_lecture_bd105</th>
                                        <th>err_lecture_bd106</th>
                                        <th>err_lecture_bd121</th>
                                        <th>err_lecture_bd123</th>
                                        <th>err_lecture_bd125</th>
                                        <th>err_lecture_bd127</th>
                                        <th>err_lecture_bd130</th>
                                        <th>err_lecture_bd134</th>
                                        <th>err_lecture_bd140</th>
                                        <th>err_lecture_bd144</th>
                                        <th>lecture_bd101</th>
                                        <th>lecture_bd105</th>
                                        <th>lecture_bd106</th>
                                        <th>lecture_bd121</th>
                                        <th>lecture_bd125</th>
                                        <th>lecture_bd127</th>
                                        <th>lecture_bd130</th>
                                        <th>lecture_bd134</th>
                                        <th>lecture_bd135</th>
                                        <th>lecture_bd140</th>
                                        <th>lecture_bd144</th>
                                        <th>lecture_bd153</th>
                                        <th>lecture_bd234</th>
                                        <th>err_lecture_bd234</th>
                                        <th>err_lecture_bd135</th>
                                        <th>err_lecture_bd153</th>
                                        <th>valid</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($showStats as $stat)
                                        <tr>
                                            @if(Auth::user()->email == 'greeftdc@gmail.com')
                                                <td><a class="btn btn-danger btn-xs" href="{{ route('modificationStats' ,
                                                 ['id'=>$stat->id] ) }}"><i class="fa fa-gear"></i> Edit.</a></td>
                                            @endif
                                                <th>{{ $stat->id }}</th>
                                            <td>{{ $stat->date }}</td>
                                            <td>{{ $stat->nombre_de_bagages_inspecte_par_eds01 }}</td>
                                            <td>{{ $stat->nombre_de_bagages_acceptes_niveau_1_par_eds01 }}</td>
                                            <td>{{ $stat->nombre_de_bagages_acceptes_niveau_2_par_operateur_eds01 }}</td>
                                            <td>{{ $stat->nombre_de_bagages_acceptes_par_le_tomographe_ou_loperateur }}</td>
                                            <td>{{ $stat->nombre_de_bagages_injectes_depuis_la_ligne_correspondance }}</td>
                                            <td>{{ $stat->nombre_de_bagages_envoyes_au_local_fouille }}</td>
                                            <td>{{ $stat->nombre_de_bagages_injectes_depuis_la_ligne_hors_gabarit }}</td>
                                            <td>{{ $stat->nombre_de_bagages_declares_inconnu_par_le_tomographe }}</td>
                                            <td>{{ $stat->nombre_de_bagages_inspectes_par_le_tomographe }}</td>
                                            <td>{{ $stat->nombre_de_bagages_injectes_par_la_ligne_1 }}</td>
                                            <td>{{ $stat->nombre_de_bagages_injectes_par_la_ligne_2 }}</td>
                                            <td>{{ $stat->nombre_de_bagages_envoyes_vers_chute_hors_gabarit }}</td>
                                            <td>{{ $stat->nombre_de_bagages_envoyes_vers_le_tomographe_par_la_fonction_s }}</td>
                                            <td>{{ $stat->nombre_de_bagages_sans_decision_niveau_1_par_eds01 }}</td>
                                            <td>{{ $stat->nombre_de_bagages_sans_decision_niveau_2_par_operateur_eds01 }}</td>
                                            <td>{{ $stat->nombre_de_bagages_rejetes_niveau_1_par_eds01 }}</td>
                                            <td>{{ $stat->nombre_de_bagages_rejetes_niveau_2_par_operateur_eds01 }}</td>
                                            <td>{{ $stat->nombre_de_bagages_rejetes_par_le_tomographe_ou_loperateur }}</td>
                                            <td>{{ $stat->nombre_de_bagages_envoyes_vers_tomographe_par_suite_a_un_reje }}</td>
                                            <td>{{ $stat->nombre_de_bagages_envoyes_vers_fouille_suite_a_un_rejet_techn }}</td>
                                            <td>{{ $stat->nombre_de_bagages_envoyes_vers_tomographe_par_saturation_aval }}</td>
                                            <td>{{ $stat->nombre_de_bagages_en_mode_degrade }}</td>
                                            <td>{{ $stat->temps_de_fonctionnement_en_mode_nominal_surete_en_mn }}</td>
                                            <td>{{ $stat->temps_de_fonctionnement_en_mode_degrade_eds01_en_mn }}</td>
                                            <td>{{ $stat->temps_de_fonctionnement_en_mode_degrade_tomo_en_mn }}</td>
                                            <td>{{ $stat->nombre_de_bagages_envoyes_vers_chute_rejet }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq01_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq02_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq03_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq04_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq05_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq06_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq07_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq08_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq09_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq10_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq11_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq12_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq14_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq15_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq16_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_c_bq17_com }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_ligne_correspondance }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_ligne_hors_gabarit }}</td>
                                            <td>{{ $stat->abscence_de_reponse_bag_2000_local_de_fouille }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_local_de_foui }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_hors_gab }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_ligne_corresp }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq17_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq16_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq15_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq14_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq12_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq11_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq10_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq09_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq08_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq07_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq06_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq05_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq04_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq03_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq02_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_c_bq01_r }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri_l }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de_tri }}</td>
                                            <td>{{ $stat->envoye_dans_le_chute_r_par_decision_de_bag2000_perte_de }}</td>
                                            <td>{{ $stat->err_ecriture_bd101 }}</td>
                                            <td>{{ $stat->err_ecriture_bd105 }}</td>
                                            <td>{{ $stat->ecriture_bd106 }}</td>
                                            <td>{{ $stat->ecriture_bd121 }}</td>
                                            <td>{{ $stat->ecriture_bd125 }}</td>
                                            <td>{{ $stat->ecriture_bd127 }}</td>
                                            <td>{{ $stat->ecriture_bd130 }}</td>
                                            <td>{{ $stat->ecriture_bd134 }}</td>
                                            <td>{{ $stat->ecriture_bd140 }}</td>
                                            <td>{{ $stat->ecriture_bd144 }}</td>
                                            <td>{{ $stat->err_ecriture_bd106 }}</td>
                                            <td>{{ $stat->err_ecriture_bd121 }}</td>
                                            <td>{{ $stat->err_ecriture_bd123 }}</td>
                                            <td>{{ $stat->err_ecriture_bd125 }}</td>
                                            <td>{{ $stat->err_ecriture_bd127 }}</td>
                                            <td>{{ $stat->err_ecriture_bd130 }}</td>
                                            <td>{{ $stat->err_ecriture_bd134 }}</td>
                                            <td>{{ $stat->err_ecriture_bd140 }}</td>
                                            <td>{{ $stat->err_ecriture_bd144 }}</td>
                                            <td>{{ $stat->err_lecture_bd101 }}</td>
                                            <td>{{ $stat->err_lecture_bd105 }}</td>
                                            <td>{{ $stat->err_lecture_bd106 }}</td>
                                            <td>{{ $stat->err_lecture_bd121 }}</td>
                                            <td>{{ $stat->err_lecture_bd123 }}</td>
                                            <td>{{ $stat->err_lecture_bd125 }}</td>
                                            <td>{{ $stat->err_lecture_bd127 }}</td>
                                            <td>{{ $stat->err_lecture_bd130 }}</td>
                                            <td>{{ $stat->err_lecture_bd134 }}</td>
                                            <td>{{ $stat->err_lecture_bd140 }}</td>
                                            <td>{{ $stat->err_lecture_bd144 }}</td>
                                            <td>{{ $stat->lecture_bd101 }}</td>
                                            <td>{{ $stat->lecture_bd105 }}</td>
                                            <td>{{ $stat->lecture_bd106 }}</td>
                                            <td>{{ $stat->lecture_bd121 }}</td>
                                            <td>{{ $stat->lecture_bd125 }}</td>
                                            <td>{{ $stat->lecture_bd127 }}</td>
                                            <td>{{ $stat->lecture_bd130 }}</td>
                                            <td>{{ $stat->lecture_bd134 }}</td>
                                            <td>{{ $stat->lecture_bd135 }}</td>
                                            <td>{{ $stat->lecture_bd140 }}</td>
                                            <td>{{ $stat->lecture_bd144 }}</td>
                                            <td>{{ $stat->lecture_bd153 }}</td>
                                            <td>{{ $stat->lecture_bd234 }}</td>
                                            <td>{{ $stat->err_lecture_bd234 }}</td>
                                            <td>{{ $stat->err_lecture_bd135 }}</td>
                                            <td>{{ $stat->err_lecture_bd153 }}</td>
                                            <td>{{ $stat->valid }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            {!! $showStats->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer content -->
        <footer>
            <div class="">
                <p class="pull-right">Stats CBS - LOPEZ Dominique
                    <span class="lead"> <i class="fa fa-paw"></i> Stats CBS</span>
                </p>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
@endsection