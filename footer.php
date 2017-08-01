<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    $_SESSION['registering'] = "0";
}

?>

<div id="login_pop" class="mfp-hide">
	<div class="container">
		<div class="fh5co-spacer fh5co-spacer-lg">
		</div>
		<div class="row login_popup">
			<div class="col-md-8 col-md-offset-2">
				<img class="img-responsive" src="images/socialtags.png" />
			</div>
			<div class="fh5co-spacer fh5co-spacer-xs">
			</div>
			<div class="col-md-12 col-md-offset-4">
				<h1 class="heading">
					<?echo $welcome;?>
						SocialTags
				</h1>
			</div>
			<div class="fh5co-spacer fh5co-spacer-md">
			</div>
			<form action="submit_validation.php" method="post" class="cmxform" id="form_login">
				<div class="col-md-12 col-md-offset-4">
					<label for="login_email" class="sr-only">
						E-mail
					</label>
					<input placeholder="<?echo $email;?>" class="input-lg" name="login_email" type="email" required />
				</div>
				<div class="col-md-12 col-md-offset-4">
					<label for="login_password" class="sr-only">
						Password
					</label>
					<input placeholder="<?echo $pass;?>" class="input-lg" name="login_password" type="password" minlength="8" required />
				</div>
				<div class="fh5co-spacer fh5co-spacer-xs">
				</div>
				<div class="col-md-12 col-md-offset-4">
                    <input type="submit" name="submit" class="btn btn-primary" value="Log in" />
				</div>
			</form>
			<div class="col-md-12 col-md-offset-4">
				<a href="#registreer_pop" class="registreer">Nog geen account? Registreer u dan nu</a>
			</div>
		</div>
	</div>
	<button title="Close (Esc)" type="button" class="mfp-close">
		x
	</button>
</div>
<div id="registreer_pop" class="mfp-hide">
	<div class="container">
		<div class="fh5co-space fh5co-spacer-lg">
		</div>
		<div class="row login_popup">
			<div class="col-md-8 col-md-offset-2">
				<img class="img-responsive" src="images/socialtags.png" />
			</div>
			<div class="fh5co-spacer fh5co-spacer-xs">
			</div>
			<div class="col-md-12 col-md-offset-2">
				<h1 class="heading">
					<?echo $registreer_account;?>
						SocialTags
				</h1>
			</div>
			<div class="fh5co-spacer fh5co-spacer-xs">
			</div>
			<div class="col-md-8 col-md-offset-1">
				<form action="submit_validation.php" method="post" class="cmxform" id="form_register">
					<div class="col-md-6">
						<div class="form-group">
							<label for="voornaam" class="sr-only">
								<?echo $first_name;?>
									*
							</label>
							<input placeholder="<?echo $first_name;?>" name="voornaam" value="tahier" type="text" class="form-control input-lg" minlength="2" required/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="achternaam" class="sr-only">
								<?echo $last_name;?>
									*
							</label>
							<input placeholder="<?echo $last_name;?>" name="achternaam" value="Goelab" type="text" class="form-control input-lg" minlength="2" required/>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="bedrijfsnaam" class="sr-only">
								<?echo $company_name;?>
							</label>
							<input placeholder="<?echo $company_name;?>" name="bedrijfsnaam" type="text" class="form-control input-lg" minlength="3" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="kvk" class="sr-only">
								<?echo $kvk;?>
							</label>
							<input placeholder="<?echo $kvk;?>" name="kvk" type="text" class="form-control input-lg" minlength="8" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="btw" class="sr-only">
								<?echo $btw;?>
							</label>
							<input placeholder="<?echo $btw;?>" name="btw" type="text" class="form-control input-lg" minlength="8" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="straat" class="sr-only">
								<?echo $street;?>
									*
							</label>
							<input placeholder="<?echo $street;?>" name="straat" value="meeuwenlaan" type="text" class="form-control input-lg" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="postcode" class="sr-only">
								<?echo $zip;?>
									*
							</label>
							<input placeholder="<?echo $zip;?>" name="postcode" value="8011am" type="text" class="form-control input-lg" minlength="4" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="huisnr" class="sr-only">
								<?echo $street_nr;?>
									*
							</label>
							<input placeholder="<?echo $street_nr;?>" name="huisnr" value="29" type="text" class="form-control input-lg" required/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="toevoeging" class="sr-only">
								<?echo $addition;?>
							</label>
							<input placeholder="<?echo $addition;?>" name="toevoeging" type="text" class="form-control input-lg" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="plaats" class="sr-only">
								<?echo $place;?>
									*
							</label>
							<input placeholder="<?echo $place;?>" name="plaats" value="Zwolle" type="text" class="form-control input-lg" minlength="2" required/>
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
							<label for="provincie" class="sr-only">
								<?echo $provincie;?>
							</label>
							<input placeholder="<?echo $provincie;?>" name="provincie" type="text" class="form-control input-lg" minlength="2" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="tel" class="sr-only">
								<?echo $phone;?>
							</label>
							<input placeholder="<?echo $phone;?>" name="tel" type="text" class="form-control input-lg" minlength="10" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="mobiel" class="sr-only">
								<?echo $mob;?>
							</label>
							<input placeholder="<?echo $mob;?>" name="mobiel" type="text" class="form-control input-lg" minlength="10" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="email" class="sr-only">
								<?echo $email;?>
							</label>
							<input placeholder="<?echo $email;?>" name="email" value="goelabtahier@gmail.com" type="email" class="form-control input-lg" required/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="password" class="sr-only">
								<?echo $pass;?>
							</label>
							<input placeholder="<?echo $pass;?>" id="password" value="wachtwoord" name="password" type="password" class="form-control input-lg" minlength="8" required/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="password_repeat" class="sr-only">
								<?echo $pass_repeat;?>
							</label>
							<input placeholder="<?echo $pass_repeat;?>" value="wachtwoord" name="password_repeat" id="password_repeat" type="password" equalto="#password" class="form-control input-lg" minlength="8" required/>
						</div>
					</div>
					<div class="col-md-12 col-md-offset-4">
                        <div class="form-group">                    
						  <input class="btn btn-primary" type="submit" name="submit" value="<?echo $registreer;?>" />
                        </div>
					</div>
                    <div class="col-md-12">
                        <input type="hidden" name="register_hidden" value="<?echo $registreer;?>" />
                    </div>
				</form>
			</div>
		</div>
		<button title="Close (Esc)" type="button" class="mfp-close">
			x
		</button>
	</div> 
</div>
</div>
<footer role="contentinfo" id="fh5co-footer">
	<a href="#" class="fh5co-arrow fh5co-gotop footer-box"><i class="ti-angle-up"></i></a>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-6 footer-box">
				<h3 class="fh5co-footer-heading">
					<?php echo $about; ?>
				</h3>
				<p>
					<?php echo $about_linga;?>
				</p>
			</div>
			<div class="col-md-4 col-sm-6 footer-box">
				<h3 class="fh5co-footer-heading">
					Links
				</h3>
				<ul class="fh5co-footer-links">
					<li>
						<a href="#">Privacy Policy</a>
					</li>
					<li>
						<a href="#">Support &amp; FAQ's</a>
					</li>
					<li>
						<a href="#"><?php echo $sign_up;?></a>
					</li>
					<li>
						<a href="#">Log in</a>
					</li>
					<li>
						<a href="#">Contact</a>
					</li>
				</ul>
			</div>
			<div class="col-md-4 col-sm-12 footer-box">
				<h3 class="fh5co-footer-heading">
					<?php $volgen;?>
				</h3>
				<ul class="fh5co-social-icons">
					<li>
						<a href="#"><i class="ti-google"></i></a>
					</li>
					<li>
						<a href="#"><i class="ti-twitter-alt"></i></a>
					</li>
					<li>
						<a href="#"><i class="ti-facebook"></i></a>
					</li>
					<li>
						<a href="#"><i class="ti-instagram"></i></a>
					</li>
					<li>
						<a href="#"><i class="ti-dribbble"></i></a>
					</li>
				</ul>
			</div>
			<div class="col-md-12 footer-box">
				<div class="fh5co-copyright">
					<p>
						&copy; 2017 Linga.
						<?php echo $rechten; ?>
							.
					</p>
				</div>
			</div>
		</div>
		<!-- END row -->
		<div class="fh5co-spacer fh5co-spacer-md">
		</div>
	</div>
</footer>
<script>
    
$('.login').magnificPopup({
	items: {
		src: $('#login_pop'),
		type: 'inline'
	}
});

$('.registreer').magnificPopup({
	items: {
		src: $('#registreer_pop'),
		type: 'inline'
	}
})

$('.mfp-close').on('click', function() {
	$('.cmxform')[0].reset(), $('.cmxform')[1].reset(), $('label.error').remove();
});

$('#form_register').validate({
	rules: {
		email: {
			remote: {
           url: "validation.php" ,
           type: "post" ,
}
		}
	},
	messages: {
		voornaam: {
			required: "<?echo $error_voornaam;?>",
			minlength: "<?echo $min_length_2;?>"
		},
		achternaam: {
			required: "<?echo $error_achternaam;?>",
			minlength: "<?echo $min_length_2;?>"
		},
		straat: "<?echo $error_street;?>",
		postcode: {
			required: "<?echo $error_zip;?>",
			minlength: "<?echo $min_length_4;?>"
		},
		huisnr: "<?echo $error_streetnr;?>",
		plaats: {
			required: "<?echo $error_place;?>",
			minlength: "<?echo $min_length_2;?>"
		},
		email: {
			required: "<?echo $error_email;?>",
			email: "<?echo $error_valid_email;?>",
			remote: "<?echo $error_in_use_email;?>"
		},
		password: {
			required: "<?echo $error_pass;?>",
			minlength: "<?echo $min_length_8;?>"
		},
		password_repeat: {
			required: "<?echo $error_pass_repeat;?>",
			minlength: "<?echo $min_length_8;?>",
			equalTo: "<?echo $error_equal;?>"
		},
		kvk: "<?echo $min_length_8;?>",
		btw: "<?echo $min_length_8;?>",
		bedrijfsnaam: "<?echo $min_length_3;?>",
		provincie: "<?echo $min_length_2;?>",
		tel: "<?echo $min_length_10;?>",
		mobiel: "<?echo $min_length_10;?>",
	}
});

$('#form_login').validate({
    rules: {
        login_email: {
            remote: {
                url: "login.php",
                type: "post",
            }
        },
        login_password: {
            remote: {
                url: "login.php",
                type: "post",
            }
        }
    },
	messages: {
		login_email: {
			required: "<?echo $error_email;?>",
			email: "<?echo $error_valid_email;?>",
            remote: "<?echo $error_invalid_email;?>"
		},
		login_password: {
			required: "<?echo $error_pass;?>",
			minlength: "<?echo $min_length_8;?>",
            remote: "<?echo $error_login_password;?>",
		}
	}
});

$('#form_contact').validate({
	messages: {
		voornaam: {
			required: "<?echo $error_voornaam;?>",
			minlength: "<?echo $min_length_2;?>"
		},
		achternaam: {
			required: "<?echo $error_achternaam;?>",
			minlength: "<?echo $min_length_2;?>"
		},
		bedrijsnaam: "<?echo $min_length_2;?>",
		functie: "<?echo $min_length_2;?>",
		tel: {
			required: "<?echo $error_tel;?>",
			minlength: "<?echo $min_length_10;?>"
		},
		email: {
			required: "<?echo $error_email;?>",
			email: "<?echo $error_valid_email;?>"
		},
		bericht: {
			required: "<?echo $error_bericht;?>",
			minlength: "<?echo $min_length_20;?>",
		}
	}
});

$('#form_contact_submit').on('click', function() {
	$('.alert-box').remove();
	if ($('#form_contact').valid()) {
		$('#form_contact').append("<div class='col-md-12 alert-box submit_success'><span>succes: </span>Uw vraag is succesvol verstuurd.</div>");
	} else {
		$('#form_contact').append("<div class='col-md-12 alert-box submit_error'><span>fout: </span>Er zijn fouten gevonden in het formulier.</div>")
	}
});

$('#form_contact').submit(function(e) {
	e.preventDefault();
});

$('#form_account').validate({
    rules:{
        email: {
            remote: {
                url: "edited_email_validation.php",
                type: "post",
            }
        },
        tel: {
            number:true
        },
        huisnr:{
            number:true            
        },
        voornaam: {
            lettersonly:true
        },
        achternaam: {
            lettersonly:true
        },
        plaats: {
            lettersonly:true
        },
    },                                           
    messages: {
        voornaam: {
            minlength: "<?echo $min_length_2;?>",
            required: "<?echo $error_voornaam;?>",
            lettersonly: "<?echo $error_letter;?>"  
        },
        achternaam: {
            minlength: "<?echo $min_length_2;?>",
            required: "<?echo $error_achternaam;?>",
            lettersonly: "<?echo $error_letter;?>"
        },
        postcode: {
            minlength: "<?echo $min_length_4;?>",
            required: "<?echo $error_zip;?>"  
        },
        plaats: {
            minlength: "<?echo $min_length_2;?>",
            required: "<?echo $error_place;?>",
            lettersonly: "<?echo $error_letter;?>"
        },
        straat: "<?echo $error_street;?>",
        huisnr: {
            required: "<?echo $error_streetnr;?>",
            number: "<?echo $error_number;?>"
        },
        tel: {
            minlength: "<?echo $error_tel;?>",
            number: "<?echo $error_number;?>"
        },
        email: {
            required: "<?echo $error_email;?>",
            email: "<?echo $error_valid_email;?>",
            remote: "<?echo $error_in_use_email;?>"
        },
    }    
});
$('#form_account_submit').on('click', function() {
	$('.alert-box').remove();
	if ($('#form_account').valid()) {
		$('#form_account').append("<div class='col-md-12 alert-box submit_success'><span>succes: </span>Uw gegevens zijn succesvol bijgewerkt.</div>");
	   $.post("update_account.php",$('#form_account').serialize(),function(data){	       
	   }
       );
	} else {
		$('#form_account').append("<div class='col-md-12 alert-box submit_error'><span>fout: </span>Er zijn fouten gevonden in het formulier.</div>")
	}
});
$('.disconnect').click(function(){
    $.ajax({
      url:"connect.php",
      type:"post",
      data:{disconnect:$(this).data("network")},
      success:function(data){
        if(data == "facebook_disconnect")
            $('#facebook_disconnect').hide(),
            $('#facebook_connect').show("5");
        else if(data == "twitter_disconnect")
            $('#twitter_disconnect').hide(),
            $('#twitter_connect').show("5");
        else if(data == "linkedin_disconnect")
            $('#linkedin_disconnect').hide(),
            $('#linkedin_connect').show("5");
        else if(data == "instagram_disconnect")
            $('#instagram_disconnect').hide(),
            $('#instagram_connect').show("5");
      }  
    })
});

$(document).ready(function(){
    $('#facebook_disconnect, #twitter_disconnect, #linkedin_disconnect, #instagram_disconnect').hide();
    
    $.ajax({
        url:"connect.php",
        type:"post",
        data:{connect:"connecting"},
        datatype:"json",        
        success:function(data){
            var networks = JSON.parse(data);
            
            for(var key in networks){
                console.log(networks[key]);
                if(networks[key] == "connected_facebook")
                    $('#facebook_disconnect').show(),
                    $('#facebook_connect').hide();
                    
                else if(networks[key] == "connected_twitter")
                    $('#twitter_disconnect').show(),
                    $('#twitter_connect').hide();
                    
                else if(networks[key] == "connected_linkedin")
                    $('#linkedin_disconnect').show(),
                    $('#linkedin_connect').hide();
                    
                else if(networks[key] == "connected_instagram")
                    $('#instagram_disconnect').show(),
                    $('#instagram_connect').hide();                                
                }           
            }                            
     });                         
});



$('.resp-tabs-list li').on('click', function(){
    $('.alert-box').remove();
    $('.error').remove();
});
$('.resp-tabs-list li:first-child').on('click', function(){
     $.ajax({
            url:"account.php", //the page containing php script
            type: "post", //request type,
            success:function(selectUser){
            }
    });
});

$('#network').change(function(){
   var network = $(this).val();
   switch(network){
    case "Facebook":
        $('.source-facebook').css("display","block");
        $('.source-twitter, .source-linkedin, .source-instagram').css("display","none");
        break;
    case "Twitter":
        $('.source-twitter').css("display","block");
        $('.source-facebook, .source-linkedin, .source-instagram').css("display","none");
        break;
    case "Linkedin":
        $('.source-linkedin').css("display","block");
        $('.source-facebook, .source-twitter, .source-instagram').css("display","none");
        break;
    case "Instagram":
        $('.source-instagram').css("display","block");
        $('.source-facebook, .source-twitter, .source-linkedin').css("display","none");
        break;
    
   }
});

$('#form_account').submit(function(e) {
	e.preventDefault();
});

$.validator.methods.email = function(value, element) {
	return this.optional(element) || /[a-z]+@[a-z]+\.[a-z]+/.test(value);
};
</script>
