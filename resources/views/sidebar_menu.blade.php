                <!-- sidebar menu -->
@if(!isset($urlStartAndEndDate))
{{ $urlStartAndEndDate='' }}
@endif
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Accueil <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('home').$urlStartAndEndDate }}">Synthèse</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-car"></i> Mobiles<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('stats').'/statsMobiles'.$urlStartAndEndDate }}">Opérateurs</a></li>
                                    <li><a href="{{ route('stats').'/statsMobilesLogsDays'.$urlStartAndEndDate }}">Défauts par jours</a></li>
                                    <li><a href="{{ route('stats').'/statsMobilesLogs'.$urlStartAndEndDate }}">Défauts par mois</a></li>
                                    <li><a href="{{ route('mobiles').$urlStartAndEndDate }}">Tous les mobiles</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-bank"></i> Banques <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('stats').'/statsBanques'.$urlStartAndEndDate }}">Logs automate</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-road"></i> Collecteurs <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('collecteurs') }}/ligne1{{ $urlStartAndEndDate }}">Ligne 1 - Toutes Compagnies</a></li>
                                    <li><a href="{{ route('collecteurs') }}/ligne2{{ $urlStartAndEndDate }}">Ligne 2 - Air France</a></li>
                                    <li><a href="{{ route('stats').'/statsByHours'.$urlStartAndEndDate }}">Défauts collecteurs par heures</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-code-fork"></i> Cantons <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('stats').'/statsCantons'.$urlStartAndEndDate }}">Opérateurs</a></li>
                                    <li><a href="{{ route('stats').'/statsCantonsLogs'.$urlStartAndEndDate }}">Logs automate</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-code-fork"></i> Aiguillages <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('stats').'/statsAiguillagesLogs'.$urlStartAndEndDate }}">Logs automate</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-plane"></i> Convoyeurs <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('stats').'/statsConvoyeurs'.$urlStartAndEndDate }}">Opérateurs</a></li>
                                    <li><a href="{{ route('stats').'/statsConvoyeursTRA100'.$urlStartAndEndDate }}">Logs TRA100</a></li>
                                    <li><a href="{{ route('stats').'/statsConvoyeursTRA110'.$urlStartAndEndDate }}">Logs TRA110</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-suitcase"></i> Chutes <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('stats').'/statsChutes'.$urlStartAndEndDate }}">Opérateurs</a></li>
                                    <li><a href="{{ route('stats').'/statsChutesLogs'.$urlStartAndEndDate }}">logs automate</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-bullhorn"></i> Nouveaux défauts<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('stats').'/statsNouveauxDefauts'.$urlStartAndEndDate }}">Opérateurs</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-bar-chart"></i> Maintenance <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('stats').'/statsNouveauxDefautsLogs'.$urlStartAndEndDate }}">Logs divers défauts</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-warning"></i> Dégradé Ultime<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('mdu').$urlStartAndEndDate }}">MDU</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-suitcase"></i> Tomographe<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('tomographe').$urlStartAndEndDate }}">Tomographe</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-table"></i> Stats<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('showDatasOperateurs') }}">Opérateurs</a></li>
                                    <li><a href="{{ route('showStats') }}">Stats</a></li>
                                    <li><a href="{{ route('showDefautsAutomate') }}">Logs Automate</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i>Mise à jour<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('form_upload') }}">Upload Files</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- sidebar menu -->
