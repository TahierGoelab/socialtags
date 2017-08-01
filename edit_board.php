<?php include "header.php";?>
	<div id="fh5co-main">
		<div class="container">
			<div class="fh5co-spacer fh5co-spacer-lg">
			</div>
			<div class="col-md-12 animate-box">
				<div id="fh5co-tab-feature-vertical" class="fh5co-tab">
					<ul class="resp-tabs-list hor_1">
						<li>
							<i class="fh5co-tab-menu-icon ti-ruler-pencil">
							</i>
							Posts
						</li>
						<li>
							<i class="fh5co-tab-menu-icon ti-paint-bucket">
							</i>
							Titel
						</li>
						<li>
							<i class="fh5co-tab-menu-icon ti-shopping-cart">
							</i>
							Lijsten
						</li>
					</ul>
					<div class="resp-tabs-container hor_1">
						<div>
							<div class="row">
								<div class="col-md-12">
									<h2 class="h3">
										Aesthetic Design
									</h2>
								</div>
								<div class="col-md-6">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda quis deserunt dolorem, debitis cupiditate nihil velit dolores, inventore voluptatem delectus quos atque similique natus eaque qui, nisi
										repudiandae dolore sit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum aut maxime eius magnam. Ipsa qui consequatur laborum culpa recusandae ullam repellendus, quod cum nemo consequuntur
										quidem labore minima dignissimos, eum!
									</p>
								</div>
								<div class="col-md-6">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio voluptatem, vitae nesciunt ad hic quam quisquam sit possimus officia ratione. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias,
										ex. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex fuga illum necessitatibus consequuntur aspernatur omnis quidem ut, similique esse assumenda.
									</p>
								</div>
							</div>
						</div>
						<div>
							<div class="row">
								<div class="col-md-12">
									<h2 class="h3">
										Board Details
									</h2>
								</div>
								<div class="fh5co-spacer fh5co-spacer-xs">
								</div>
								<form action="#" method="post">
									<div class="col-md-10">
										<div class="form-group">
											<label for="title" class="sr-only">
												<?echo $board_title;?>
											</label>
											<input placeholder="Titel uit database" name="title" type="text" class="form-control input-lg">
										</div>
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<label for="link" class="sr-only">
												Link
											</label>
											<input placeholder="Link uit database" name="link" type="text" class="form-control input-lg">
										</div>
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<label for="logo" class="sr-only">
												Logo
											</label>
											<input placeholder="Upload uit database" name="logo" type="text" class="form-control input-lg">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<button>
												<i class="ti-upload">
												</i>
											</button>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<button class="btn btn-success">
												<?echo $save;?>
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div>
							<div class="row">
								<div class="col-md-12">
									<h2 class="h3">
										Mijn lijsten
									</h2>
								</div>
								<div class="col-md-12">
									<button class="btn btn-primary">
										<?echo $add_list;?>
									</button>
								</div>
								<div class="col-md-12">
									<select id="lists" name="lists">
										<option>
											Whitelist 1
										</option>
										<option>
											Whitelist 2
										</option>
										<option>
											Blacklist 1
										</option>
										<option>
											Blacklist 2
										</option>
									</select>
								</div>
								<div class="fh5co-spacer fh5co-spacer-xs">
								</div>
								<div class="col-md-6">
									<textarea id="list_words" class="input-lg" rows="6" readonly="readonly"> Woord 1&#13; Woord 2&#13; Woord 3&#13; Woord 4&#13; Woord 5&#13; Woord 6
									</textarea>
								</div>
                                <div class="col-md-6">&nbsp;</div>
                                <div class="col-md-6">&nbsp;</div>
                                <div class="col-md-6">
                                    <a href="#"><i class="ti-pencil"></i></a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#"><i class="ti-trash"></i></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.php";?>