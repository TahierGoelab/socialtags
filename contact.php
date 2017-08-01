<?php include "header.php";?>
		
		
		<div id="fh5co-hero">
			<a href="#fh5co-main" class="smoothscroll fh5co-arrow to-animate hero-animate-4"><i class="ti-angle-down"></i></a>
			<!-- End fh5co-arrow -->
			<div class="container">
				<div class="col-md-8 col-md-offset-2">
					<div class="fh5co-hero-wrap">
						<div class="fh5co-hero-intro">
							<h1 class="to-animate hero-animate-1">Contact</h1>
							<h2 class="to-animate hero-animate-2"><?php echo $contact;?></h2>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<div id="fh5co-main">
			<div class="container">
				<div class="row" id="fh5co-features">

					<div class="fh5co-spacer fh5co-spacer-sm"></div>	
					<div class="col-md-8 fh5co-feature feature-box" id="div_contact">
						<form class="cmxform" method="post" id="form_contact">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="aanhef" class="sr-only"><?php echo $aanhef;?>*</label>
                                    <select id="aanhef" name="aanhef" class="form-control">
                                        <option><?php echo $option_male;?></option>
                                        <option><?php echo $option_female;?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
								<div class="form-group">
									<label for="voornaam" class="sr-only"><?echo $first_name;?>*</label>
									<input placeholder="<?echo $first_name;?>" id="voornaam" name="voornaam" type="text" value="Tahier" class="form-control input-lg" minlength="2" required>
								</div>	
							</div>
                            <div class="col-md-12">
								<div class="form-group">
									<label for="tussenvoegsel" class="sr-only"><?echo $addition;?></label>
									<input placeholder="<?echo $addition;?>" id="tussenvoegsel" name="tussenvoegsel" type="text" class="form-control input-lg">
								</div>	
							</div>
                            <div class="col-md-12">
								<div class="form-group">
									<label for="achternaam" class="sr-only"><?echo $last_name;?>*</label>
									<input placeholder="<?echo $last_name;?>" id="achternaam" name="achternaam" type="text" value="Goelab" class="form-control input-lg" minlength="2" required>
								</div>	
							</div>
                            <div class="col-md-12">
								<div class="form-group">
									<label for="bedrijfsnaam" class="sr-only"><?echo $company_name;?></label>
									<input placeholder="<?echo $company_name;?>" id="bedrijfsnaam" name="bedrijfsnaam" type="text" class="form-control input-lg" minlength="2">
								</div>	
							</div>
                            <div class="col-md-12">
								<div class="form-group">
									<label for="functie" class="sr-only"><?echo $function;?></label>
									<input placeholder="<?echo $function;?>" id="functie" name="functie" type="text" class="form-control input-lg" minlength="2">
								</div>	
							</div>
                            <div class="col-md-12">
								<div class="form-group">
									<label for="tel" class="sr-only"><?echo $phone;?>*</label>
									<input placeholder="<?echo $phone;?>" id="tel" name="tel" type="text" value="06442778991" class="form-control input-lg" minlength="10" required>
								</div>	
							</div>
                            <div class="col-md-12">
								<div class="form-group">
									<label for="email" class="sr-only"><?echo $email;?>*</label>
									<input placeholder="<?echo $email;?>" id="email" name="email" type="email" value="goelab@lingaweb.nl" class="form-control input-lg" required>
								</div>	
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									<label for="bericht" class="sr-only"><?echo $question;?>*</label>
									<textarea placeholder="<?echo $question;?>" id="bericht" name="bericht" class="form-control input-lg" rows="3" minlength="20" required>Mijn bericht met uit minimaal 20 tekens bestaan</textarea>
								</div>	
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" class="btn btn-primary btn-lg" id="form_contact_submit" value="<?echo $contact_btn;?>">
								</div>	
							</div>
							
							
						</form>	
						
					</div>
					<div class="col-md-4 fh5co-feature feature-box">
						<h3><?php echo $help;?></h3>
						<p><?php echo $fill_contact;?>
					</div>

					<div class="fh5co-spacer fh5co-spacer-md"></div>	

				</div>
			</div>

		
		</div>
		<!-- END fhtco-main -->
<?php include "footer.php";?>