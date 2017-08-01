<?php include "header.php";
require_once (__dir__ . '/Facebook/autoload.php');
require_once (__dir__ . '/Twitter/twitteroauth/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

    $database = new Database("localhost", "socialtags_web", "socialtags_tah",
        "?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
    $database->establishConnection();
            
    function selectUser(){  
        $database = new Database("localhost", "socialtags_web", "socialtags_tah",
        "?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
        $database->establishConnection();     
        $result = $database->selectSocialTagsUser($_SESSION['login_email']);      
        $user = mysqli_fetch_assoc($result);   
        
        return $user;
        }             
            
    $user = selectUser();        
                  
    //Create Facebook url                                      
    $fb = new Facebook\Facebook(['app_id' => '769049933272707', 'app_secret' =>
        'b2ca086583262bb5ab6106144ca76384', 'default_graph_version' => 'v2.8', ]);
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['user_posts', 'email', 'user_likes', 'manage_pages'];
    $facebook_url= $helper->getLoginUrl('http://socialtags.gcid.nl/login-facebook.php', $permissions);
    
    //Create Twitter url
    $consumerkey = 'VqFwhKjLDgbrdJvDYTTvFUrTK';
    $consumersecret = 'lBjk8ICagWk3ipX0BmtZMXAaTAl6HDHlsvcEOhPcYNKGDRcrNw';
    $twitter_connection = new TwitterOAuth($consumerkey, $consumersecret);
    $receive_token = $twitter_connection->oauth('oauth/request_token', array('oauth_callback' =>
        'http://socialtags.gcid.nl/login-twitter.php'));
    $twitter_url = $twitter_connection->url('oauth/authorize', array('oauth_token' => $receive_token['oauth_token']));
    $_SESSION['oauth_token'] = $receive_token['oauth_token'];
    $_SESSION['oauth_token_secret'] = $receive_token['oauth_token_secret'];
    
    //Create Linkedin url
    $linkedin_callback = "http://socialtags.gcid.nl/login-linkedin.php";
    $linkedin_clientid = "78hp5f7zqto4b1";
    $linked_secret = "9jDtwtckA47a7IH0";
    $linkedin_url = 'https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=' . $linkedin_clientid . 
        '&redirect_uri=' . $linkedin_callback . '&state=98765EeFWf45A53sdfKef4233&scope=r_basicprofile r_emailaddress w_share rw_company_admin"';   
        
    //Create Instagram url
    $client_id = "d50a6dc1ae0d4cd49b83137cb8f97421";
    $instagram_url = 'https://api.instagram.com/oauth/authorize/?client_id=' .$client_id . 
        '&redirect_uri=http://socialtags.gcid.nl/login-instagram.php&response_type=code&scope=basic public_content follower_list';
                                    
        
    $connected_accounts = $database->selectLinkedAccounts($user['id']);
    foreach($connected_accounts as $id => $account){
        if($account['network']=='facebook'){
            $connected_facebook = $id;
        }
        elseif($account['network']=='twitter'){
            $connected_twitter = $id;
        }
        elseif($account['network']=='linkedin'){
            $connected_linkedin = $id;
        }
        elseif($account['network']=='instagram'){
            $connected_instagram = $id;
        }                                      
    }    
           
    if(isset($_SESSION['inserted_facebook']) && $_SESSION['inserted_facebook'] == '1'){
        echo "<script>alert('Succesvol connectie gemaakt met Facebook');</script>";
    unset($_SESSION['inserted_facebook']);
    }
    elseif(isset($_SESSION['inserted_twitter']) && $_SESSION['inserted_twitter'] == '1'){
        echo "<script>alert('Succesvol connectie gemaakt met Twitter');</script>";
        unset($_SESSION['inserted_twitter']);
    }
    elseif(isset($_SESSION['inserted_linkedin']) && $_SESSION['inserted_linkedin'] == '1'){
        echo "<script>alert('Succesvol connectie gemaakt met Linkedin');</script>";
        unset($_SESSION['inserted_linkedin']);
    }
    elseif(isset($_SESSION['inserted_instagram']) && $_SESSION['inserted_instagram'] == '1'){
        echo "<script>alert('Succesvol connectie gemaakt met Instagram');</script>";
        unset($_SESSION['inserted_instagram']);
    }
        
?>
	<div id="fh5co-main">
		<div class="container">
			<div class="row">
                
			     <div class="fh5co-spacer fh5co-spacer-sm"></div>	
                    
				<div class="col-md-12 animate-box">
					<div id="fh5co-tab-feature-vertical" class="fh5co-tab">
						<ul class="resp-tabs-list hor_1">
							<li>
								<i class="fh5co-tab-menu-icon ti-ruler-pencil">
								</i>
								<?php echo $details; ?>
							</li>
							<li>
								<i class="fh5co-tab-menu-icon ti-paint-bucket">
								</i>
								<?php echo $accounts; ?>
							</li>
							<li>
								<i class="fh5co-tab-menu-icon ti-shopping-cart">
								</i>
								<?php echo $sources; ?>
							</li>
						</ul>
						<div class="resp-tabs-container hor_1">
							<div>
								<div class="row animate-box">
									<div class="col-md-12">
										<h2 class="h3">
											<?php echo $details; ?>
										</h2>
									</div>
									<div class="col-md-12">
										<form class="cmxform" method="post" id="form_account">
											<div class="col-md-12">
												<div class="form-group">
													<label for="voornaam" class="sr-only">
														<? echo $first_name; ?>
															*
													</label>
													<input placeholder="<? echo $first_name; ?>" id="voornaam" name="voornaam" type="text" value="<? echo $user['first_name']; ?>" class="form-control input-lg" minlength="2" required>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="tussenvoegsel" class="sr-only">
														<? echo $addition; ?>
															*
													</label>
													<input placeholder="<? echo $addition; ?>" id="toevoeging" name="tussenvoegsel" type="text" class="form-control input-lg">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="achternaam" class="sr-only">
														<? echo $last_name; ?>
															*
													</label>
													<input placeholder="<? echo $last_name; ?>" id="achternaam" name="achternaam" type="text" value="<? echo $user['last_name']; ?>" class="form-control input-lg" minlength="2" required>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="postcode" class="sr-only">
														<? echo $zip; ?>
															*
													</label>
													<input placeholder="<? echo $zip; ?>" id="postcode" name="postcode" type="text" value="<? echo $user['zip_code']; ?>" class="form-control input-lg" minlength="4" required>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="plaats" class="sr-only">
														<? echo $place; ?>
															*
													</label>
													<input placeholder="<? echo $place; ?>" id="plaats" name="plaats" type="text" value="<? echo $user['place']; ?>" class="form-control input-lg" minlength="2" required>
												</div>
											</div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="provincie" class="sr-only"><? echo $provincie; ?></label>
                                                    <input placeholder="<? echo $provincie; ?>" id="provincie" name="provincie" type="text" value="<? $user['province']; ?>" class="form-control input-lg">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
						<div class="form-group">
							<label for="land" class="sr-only">
								<?echo $land;?>
									*
							</label>
							<select id="land" name="land" class="form-control land">
								<option>
									Afghanistan
								</option>
								<option>
									&Aring;land Eilanden
								</option>
								<option>
									Albani&euml;
								</option>
								<option>
									Algerije
								</option>
								<option>
									Amerikaanse Maagdeneilanden
								</option>
								<option>
									Amerikaans-Samoa
								</option>
								<option>
									Andorra
								</option>
								<option>
									Angola
								</option>
								<option>
									Anguilla
								</option>
								<option>
									Antarctica
								</option>
								<option>
									Antigua en Barbuda
								</option>
								<option>
									Argentini&euml;
								</option>
								<option>
									Armeni&euml;
								</option>
								<option>
									Aruba
								</option>
								<option>
									Australi&euml;
								</option>
								<option>
									Azerbeidzjan
								</option>
								<option>
									Bahama's
								</option>
								<option>
									Bahrein
								</option>
								<option>
									Bangladesh
								</option>
								<option>
									Barbados
								</option>
								<option>
									Belgi&euml;
								</option>
								<option>
									Belize
								</option>
								<option>
									Benin
								</option>
								<option>
									Bermuda
								</option>
								<option>
									Bhutan
								</option>
								<option>
									Bolivia
								</option>
								<option>
									Bonaire, Sint Eustatius en Saba
								</option>
								<option>
									Bosni&euml; en Herzegovina
								</option>
								<option>
									Botswana
								</option>
								<option>
									Bouveteiland
								</option>
								<option>
									Brazili&euml;
								</option>
								<option>
									Britse Maagdeneilanden
								</option>
								<option>
									Brits Indische Oceaanterritorium
								</option>
								<option>
									Brunei
								</option>
								<option>
									Bulgarije
								</option>
								<option>
									Burkina Faso
								</option>
								<option>
									Burundi
								</option>
								<option>
									Cambodja
								</option>
								<option>
									Canada
								</option>
								<option>
									Centraal-Afrikaanse Republiek
								</option>
								<option>
									Chili
								</option>
								<option>
									China
								</option>
								<option>
									Christmaseiland
								</option>
								<option>
									Cocoseilanden
								</option>
								<option>
									Colombia
								</option>
								<option>
									Comoren
								</option>
								<option>
									Congo-Brazzaville
								</option>
								<option>
									Congo-Kinshasa
								</option>
								<option>
									Cookeilanden
								</option>
								<option>
									Costa Rica
								</option>
								<option>
									Cuba
								</option>
								<option>
									Cura&ccedil;ao
								</option>
								<option>
									Cyprus
								</option>
								<option>
									Denemarken
								</option>
								<option>
									Djibouti
								</option>
								<option>
									Dominica
								</option>
								<option>
									Dominicaanse Republiek
								</option>
								<option>
									Duitsland
								</option>
								<option>
									Ecuador
								</option>
								<option>
									Egypte
								</option>
								<option>
									El Salvador
								</option>
								<option>
									Equatoriaal-Guinea
								</option>
								<option>
									Eritrea
								</option>
								<option>
									Estland
								</option>
								<option>
									Ethiopi&euml;
								</option>
								<option>
									Faer&ouml;er
								</option>
								<option>
									Falklandeilanden
								</option>
								<option>
									Fiji
								</option>
								<option>
									Filipijnen
								</option>
								<option>
									Finland
								</option>
								<option>
									Frankrijk
								</option>
								<option>
									Franse Zuidelijke en Antarctische Gebieden
								</option>
								<option>
									Frans-Guyana
								</option>
								<option>
									Frans-Polynesi&euml;
								</option>
								<option>
									Gabon
								</option>
								<option>
									Gambia
								</option>
								<option>
									Georgi&euml;
								</option>
								<option>
									Ghana
								</option>
								<option>
									Gibraltar
								</option>
								<option>
									Grenada
								</option>
								<option>
									Griekenland
								</option>
								<option>
									Groenland
								</option>
								<option>
									Guadeloupe
								</option>
								<option>
									Guam
								</option>
								<option>
									Guatemala
								</option>
								<option>
									Guernsey
								</option>
								<option>
									Guinee
								</option>
								<option>
									Guinee-Bissau
								</option>
								<option>
									Guyana
								</option>
								<option>
									Ha&iuml;ti
								</option>
								<option>
									Heard en McDonaldeilanden
								</option>
								<option>
									Honduras
								</option>
								<option>
									Hongarije
								</option>
								<option>
									Hongkong
								</option>
								<option>
									Ierland
								</option>
								<option>
									IJsland
								</option>
								<option>
									India
								</option>
								<option>
									Indonesi&euml;
								</option>
								<option>
									Irak
								</option>
								<option>
									Iran
								</option>
								<option>
									Isra&euml;l
								</option>
								<option>
									Itali&euml;
								</option>
								<option>
									Ivoorkust
								</option>
								<option>
									Jamaica
								</option>
								<option>
									Japan
								</option>
								<option>
									Jemen
								</option>
								<option>
									Jersey
								</option>
								<option>
									Jordani&euml;
								</option>
								<option>
									Kaaimaneilanden
								</option>
								<option>
									Kaapverdi&euml;
								</option>
								<option>
									Kameroen
								</option>
								<option>
									Kazachstan
								</option>
								<option>
									Kenia
								</option>
								<option>
									Kirgizi&euml;
								</option>
								<option>
									Kiribati
								</option>
								<option>
									Kleine Pacifische eilanden van de V.S.
								</option>
								<option>
									Koeweit
								</option>
								<option>
									Kroati&euml;
								</option>
								<option>
									Laos
								</option>
								<option>
									Lesotho
								</option>
								<option>
									Letland
								</option>
								<option>
									Libanon
								</option>
								<option>
									Liberia
								</option>
								<option>
									Libi&euml;
								</option>
								<option>
									Liechtenstein
								</option>
								<option>
									Litouwen
								</option>
								<option>
									Luxemburg
								</option>
								<option>
									Macau
								</option>
								<option>
									Macedoni&euml;
								</option>
								<option>
									Madagaskar
								</option>
								<option>
									Malawi
								</option>
								<option>
									Maldiven
								</option>
								<option>
									Maleisi&euml;
								</option>
								<option>
									Mali
								</option>
								<option>
									Malta
								</option>
								<option>
									Man
								</option>
								<option>
									Marokko
								</option>
								<option>
									Marshalleilanden
								</option>
								<option>
									Martinique
								</option>
								<option>
									Mauritani&euml;
								</option>
								<option>
									Mauritius
								</option>
								<option>
									Mayotte
								</option>
								<option>
									Mexico
								</option>
								<option>
									Micronesia
								</option>
								<option>
									Moldavi&euml;
								</option>
								<option>
									Monaco
								</option>
								<option>
									Mongoli&euml;
								</option>
								<option>
									Montenegro
								</option>
								<option>
									Montserrat
								</option>
								<option>
									Mozambique
								</option>
								<option>
									Myanmar
								</option>
								<option>
									Namibi&euml;
								</option>
								<option>
									Nauru
								</option>
								<option selected>
									Nederland
								</option>
								<option>
									Nepal
								</option>
								<option>
									Nicaragua
								</option>
								<option>
									Nieuw-Caledoni&euml;
								</option>
								<option>
									Nieuw-Zeeland
								</option>
								<option>
									Niger
								</option>
								<option>
									Nigeria
								</option>
								<option>
									Niue
								</option>
								<option>
									Noordelijke Marianen
								</option>
								<option>
									Noord-Korea
								</option>
								<option>
									Noorwegen
								</option>
								<option>
									Norfolk
								</option>
								<option>
									Oeganda
								</option>
								<option>
									Oekra&iuml;ne
								</option>
								<option>
									Oezbekistan
								</option>
								<option>
									Oman
								</option>
								<option>
									Oostenrijk
								</option>
								<option>
									Oost-Timor
								</option>
								<option>
									Pakistan
								</option>
								<option>
									Palau
								</option>
								<option>
									Palestina
								</option>
								<option>
									Panama
								</option>
								<option>
									Papoea-Nieuw-Guinea
								</option>
								<option>
									Paraguay
								</option>
								<option>
									Peru
								</option>
								<option>
									Pitcairneilanden
								</option>
								<option>
									Polen
								</option>
								<option>
									Portugal
								</option>
								<option>
									Puerto Rico
								</option>
								<option>
									Qatar
								</option>
								<option>
									R&eacute;union
								</option>
								<option>
									Roemeni&euml;
								</option>
								<option>
									Rusland
								</option>
								<option>
									Rwanda
								</option>
								<option>
									Saint-Barth&eacute;lemy
								</option>
								<option>
									Saint Kitts en Nevis
								</option>
								<option>
									Saint Lucia
								</option>
								<option>
									Saint-Pierre en Miquelon
								</option>
								<option>
									Saint Vincent en de Grenadines
								</option>
								<option>
									Salomonseilanden
								</option>
								<option>
									Samoa
								</option>
								<option>
									San Marino
								</option>
								<option>
									Saoedi-Arabi&euml;
								</option>
								<option>
									Sao Tom&eacute; en Principe
								</option>
								<option>
									Senegal
								</option>
								<option>
									Servi&euml;
								</option>
								<option>
									Seychellen
								</option>
								<option>
									Sierra Leone
								</option>
								<option>
									Singapore
								</option>
								<option>
									Sint-Helena, Ascension en Tristan da Cunha
								</option>
								<option>
									Sint-Maarten
								</option>
								<option>
									Sint Maarten
								</option>
								<option>
									Sloveni&euml;
								</option>
								<option>
									Slowakije
								</option>
								<option>
									Soedan
								</option>
								<option>
									Somali&euml;
								</option>
								<option>
									Spanje
								</option>
								<option>
									Spitsbergen en Jan Mayen
								</option>
								<option>
									Sri Lanka
								</option>
								<option>
									Suriname
								</option>
								<option>
									Swaziland
								</option>
								<option>
									Syri&euml;
								</option>
								<option>
									Tadzjikistan
								</option>
								<option>
									Taiwan
								</option>
								<option>
									Tanzania
								</option>
								<option>
									Thailand
								</option>
								<option>
									Togo
								</option>
								<option>
									Tokelau
								</option>
								<option>
									Tonga
								</option>
								<option>
									Trinidad en Tobago
								</option>
								<option>
									Tsjaad
								</option>
								<option>
									Tsjechi&euml;
								</option>
								<option>
									Tunesi&euml;
								</option>
								<option>
									Turkije
								</option>
								<option>
									Turkmenistan
								</option>
								<option>
									Turks- en Caicoseilanden
								</option>
								<option>
									Tuvalu
								</option>
								<option>
									Uruguay
								</option>
								<option>
									Vanuatu
								</option>
								<option>
									Vaticaanstad
								</option>
								<option>
									Venezuela
								</option>
								<option>
									Verenigde Arabische Emiraten
								</option>
								<option>
									Verenigde Staten
								</option>
								<option>
									Verenigd Koninkrijk
								</option>
								<option>
									Vietnam
								</option>
								<option>
									Wallis en Futuna
								</option>
								<option>
									Westelijke Sahara
								</option>
								<option>
									Wit-Rusland
								</option>
								<option>
									Zambia
								</option>
								<option>
									Zimbabwe
								</option>
								<option>
									Zuid-Afrika
								</option>
								<option>
									Zuid-Georgia en de Zuidelijke Sandwicheilanden
								</option>
								<option>
									Zuid-Korea
								</option>
								<option>
									Zuid-Soedan
								</option>
								<option>
									Zweden
								</option>
								<option>
									Zwitserland
								</option>
							</select>
						</div>
					</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="straat" class="sr-only">
														<? echo $street; ?>
															*
													</label>
													<input placeholder="<? echo $street; ?>" id="straat" name="straat" type="text" value="<? echo $user['address']; ?>" class="form-control input-lg" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="huisnr" class="sr-only">
														<? echo $street_nr; ?>
															*
													</label>
													<input placeholder="<? echo $street_nr; ?>" id="huisnr" name="huisnr" type="text" value="<? echo $user['housenumber']; ?>" class="form-control input-lg" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="toevoeging" class="sr-only">
														<? echo $street_add; ?>
															*
													</label>
													<input placeholder="<? echo $street_add; ?>" id="toevoeging" type="text" class="form-control input-lg">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="tel" class="sr-only">
														<? echo $phone; ?>														
													</label>
													<input placeholder="<? echo $phone; ?>" id="tel" name="tel" type="text" value="<? echo $user['phone']; ?>" class="form-control input-lg" minlength="10">
												</div>
											</div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="mobiel" class="sr-only"><?echo $mob;?></label>
                                                    <input placeholder="<?echo $mob;?>" id="mobiel" name="mobiel" type="text" value="<?echo $user['mobile'];?>" class="form-control input-lg" minlength="10">
                                                </div>
                                            </div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="email" class="sr-only">
														<? echo $email; ?>
															*
													</label>
													<input placeholder="<? echo $email; ?>" id="email" name="email" type="email" value="<? echo $user['email']; ?>" class="form-control input-lg" required>
												</div>
											</div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="taal" class="sr-only"></label>
                                                    <select id="taal"name="taal" class="form-control">
                                                        <option <?if($user['language']=="Nederlands"){echo "selected";}?>>Nederlands</option>
                                                        <option <?if($user['language']=="English"){echo "selected";}?>>English</option>
                                                    </select>
                                                </div>
                                            </div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="submit" class="btn btn-primary btn-lg" name="submit" id="form_account_submit" value="<? echo $save; ?>">
												</div>
											</div>
										</form>
                                        <div class="col-md-12">
                                            <p><strong>Het aanpassen van uw bedrijfsgegevens is niet mogelijk. Uw kunt een verzoek hiervoor indienen door te mailen naar <a href="mailto:goelab@lingaweb.nl">Linga</a></strong></p>
                                        </div>
									</div>									
								</div>
							</div>
							<div>
								<div id="div_connections" class="row animate-box">
									<div class="col-md-12">
										<h2 class="h3">
											<? echo $connect_networks; ?>                                                      
										</h2>                                                                                                                     
                                    
                                     <div id="facebook_disconnect" class="col-md-12">
                                        <div class="col-md-8"><label><? echo $connected; ?> Facebook</label></div>
                                        <div class="col-md-4"><button data-network="facebook" type="button" class="disconnect btn btn-danger"><?echo $disconnect;?></button></div>
                                    </div>                                                                                   
                                       
                                    <div id="facebook_connect" class="col-md-12">
                                        <div class="col-md-8"><label><? echo $not_connected; ?> Facebook</label></div>
                                        <div class="col-md-4"><a href="<?echo $facebook_url;?>"><button class="btn btn-facebook"><i class="fa fa-facebook"></i> | <?echo $connect;?> Facebook &nbsp;</button></a></div>
                                    </div>
                                    
                                        <div id="twitter_disconnect" class="col-md-12">
                                            <div class="col-md-8"><label><? echo $connected; ?> Twitter</label></div>
                                            <div class="col-md-4"><button data-network="twitter" type="button" class="disconnect btn btn-danger"><?echo $disconnect;?></button></div>
                                        </div>                           
                                             
                                        <div id="twitter_connect" class="col-md-12">
                                            <div class="col-md-8"><label><? echo $not_connected; ?> Twitter</label></div>
                                            <div class="col-md-4"><a href="<?echo $twitter_url;?>"><button class="btn btn-twitter"><i class="fa fa-twitter"></i> | <?echo $connect;?> Twitter &nbsp;&nbsp;&nbsp;</button></a></div>
                                        </div>
                                        
                                        <div id="linkedin_disconnect" class="col-md-12">
                                            <div class="col-md-8"><label><? echo $connected; ?> Linkedin</label></div>
                                            <div class="col-md-4"><button data-network="linkedin" class="disconnect btn btn-danger"><?echo $disconnect;?></button></div>
                                        </div>
                                                                                                        
                                                                   
                                        <div id="linkedin_connect" class="col-md-12">
                                            <div class="col-md-8"><label><? echo $not_connected; ?> Linkedin</label></div>
                                            <div class="col-md-4"><a href="<?echo $linkedin_url;?>"><button class="btn btn-linkedin"><i class="fa fa-linkedin"></i> | <?echo $connect;?> Linkedin &nbsp;&nbsp;</button></a></div>
                                        </div>
                                        
                                        <div id="instagram_disconnect" class="col-md-12">
                                            <div class="col-md-8"><label><? echo $connected; ?> Instagram</label></div>
                                            <div class="col-md-4"><button data-network="instagram" type="button" class="disconnect btn btn-danger"><?echo $disconnect;?></button></div>
                                        </div>   
                                        
                                        <div id="instagram_connect" class="col-md-12">
                                            <div class="col-md-8"><label><? echo $not_connected; ?> Instagram</label></div>
                                            <div class="col-md-4"><a href="<?echo $instagram_url;?>"><button class="btn btn-instagram"><i class="fa fa-instagram"></i> | <?echo $connect;?> Instagram</button></a></div>
                                        </div>                                                                       
                                    </div>
								</div>
							</div>
							<div>
								<div class="row animate-box">
									<div class="col-md-12">
										<h2 class="h3">
											<? echo $beheer_bronnen; ?>
										</h2>
									</div>
                                    
                                    <div class="col-md-12">
                                        <a class="btn btn-outline" id="source-btn" href="#source"><? echo $add_source; ?></a>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <img class="img-responsive" src="images/profile-icon.png" width="50px" />
                                    </div>                                    
                                    <div class="col-md-10">
                                        <h3 class="heading source">Duurzaam</h3>
                                        <p class="fh5co-category">Twitter Hashtag</p>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <img class="img-responsive" src="images/profile-icon.png" width="50px" />
                                    </div>                                    
                                    <div class="col-md-10">
                                        <h3 class="heading source">BuildingHolland</h3>
                                        <p class="fh5co-category">Facebook pagina</p>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <img class="img-responsive" src="images/profile-icon.png" width="50px" />
                                    </div>                                    
                                    <div class="col-md-10">
                                        <h3 class="heading source">goelabtahier</h3>
                                        <p class="fh5co-category">Instagram account</p>
                                    </div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
                
                <div id="source" class="mfp-hide">
                         <div class="fh5co-spacer fh5co-spacer-lg"></div>
                    <div class="container popup">
                         <div class="fh5co-spacer fh5co-spacer-lg"></div>			             
                         
                         <div class="row">
                         <form action="#" method="post">
                            <div class="col-md-6 col-md-offset-2">
                                <div id="option-facebook" class="col-md-3">
                                    <img src="images/facebook.png" class="option-img" />
                                </div>
                                <div id="option-twitter" class="col-md-3">
                                    <img src="images/twitter.png" class="option-img" />
                                </div>
                                <div id="option-linkedin" class="col-md-3">
                                    <img src="images/linkedin.png" class="option-img" />
                                </div>
                                <div id="option-instagram" class="col-md-3">
                                    <img src="images/instagram.png" class="option-img" />
                                </div>
                        
                        </div> 
                        <div class="col-md-12 animate-box">
						  <div id="source-facebook" class="source-type">
                            <select id="facebook_pages" name="facebook_pages"> 
                          <?php
                            $accounts = $database->selectLinkedAccounts($user['id']);
                            foreach($accounts as $account){
                                if($account['network'] == "facebook"){
                                    $pages = $database->selectAccountPages($account['id']);
                                    foreach($pages as $page){
                                        $page_name = $page['name'];
                                        echo "<option>$page_name</option>";
                                    }
                                }
                            }
                          ?>                                                           
                            </select>						
						</div>
                        <div id="source-twitter" class="source-type">
								
                        </div>
                        <div id="source-linkedin" class="source-type">
                            
                        </div>
                        <div id="source-instagram" class="source-type">
							<div class="resp-tabs-container hor_1">
									<div class="row">
										<div class="col-md-10 form-group">
                                        <label for="profiel" class="sr-only"><? echo $profile; ?></label>
                                            <input placeholder="<? echo $profile; ?>" id="profiel" name="profiel" type="text" class="form-control input-lg"/>
										</div>
                                        
									</div>
									<div class="row">
                                        <div class="col-md-10 form-group">
                                            <label for="tags" class="sr-only">Tags</label>
                                            <input placeholder="Tags" id="tags" name="tags" type="text" class="form-control input-lg"/>
                                        
										</div>
									</div>
									<div class="row">
										<div class="col-md-10 form-group">
                                            <label for="hashtags" class="sr-only">Hashtags</label>
                                            <input placeholder="Hashtags" id="hashtags" name="hashtags" type="text" class="form-control input-lg"/>
                                        </div>
									</div>
							</div>
                        </div>                                                                                                
					</div> 
                    
                    <div class="col-md-12 animate-box form-group">
                        <input type="submit" class="btn btn-primary" name="toevoegen" value="<? echo $save; ?>"/>
                    </div>
                         </form>
                        </div>
                    </div>
                </div>
                
			</div>
		</div>

	</div>
    <script>
        $('#source-btn').magnificPopup({
            items: {                
                src: $('#source'),
                type:'inline'
            }
        });
        </script>
	<?php include "footer.php"; ?>