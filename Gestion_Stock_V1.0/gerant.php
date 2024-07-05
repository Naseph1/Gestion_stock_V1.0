<?php 
	require("action/gerant/affichegerant.php");
	require("action/gerant/registergerant.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php require("include/head.php"); ?>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<span class="text"><?=$_SESSION['nom']?></span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="index.php">
					<span class="text">Dashboard</span>
				</a>
			</li>
			<?php
				if ($_SESSION['nom'] == 'admin') {
					?>
					<li>
						<a href="fournisseur.php">
							<span class="text">Fournisseur</span>
						</a>
					</li>
					<?php
				} 
			?>
			<li>
				<a href="produit.php">
            		<span class="text">Produit</span>
				</a>
			</li>
			<li>
				<a href="stock.php">
          			<span class="text">Stock</span>
				</a>
			</li>
			<li>
				<a href="categorie.php">
          			<span class="text">categorie</span>
				</a>
			</li>
			
			<?php
				if ($_SESSION['nom'] == 'admin') {
					?>
					<li class="active">
						<a href="gerant.php">
							<span class="text">Gerant</span>
						</a>
					</li>
					<?php
				} 
			?>
			
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#" class="logout">
           			<span class="text">Setting</span>
				</a>
			</li>
			<li>
				<a href="action/logoutaction.php" class="logout">
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<!-- <nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav> -->
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Gerant</h1>
					<!-- <ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul> -->
				</div>
				<!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a> -->
			</div>

			<form method="POST">
                <?php 
                if (isset($errormsg)) {
                    echo $errormsg;
                }
                // echo "<script language='javascript'>alert('".$_SESSION['id']."');</script>";
                ?>
                <ul class="box-info">
                    <li>
                        <span class="text">
                            <input type="text" name="nom_gerant" id="">
                            <p>Nom gerant</p>
                        </span>
                    </li>
                    <li>
                        <span class="text">
                            <input type="text" name="contact_gerant" id="">
                            <p>contact gerant</p>
                        </span>
                    </li>
                    <li>
						<span class="text">Sexe&nbsp;
							<select name="sexe_gerant" id="">
								<option value=""></option>
								<option value="homme">Homme</option>
								<option value="femme">Femme</option>
							</select>
                        </span>
                    </li>
					<li>
                        <span class="text">
                            <input type="submit" value="Enregistrer" name="validate">
                        </span>
                    </li>
                </ul>
            </form>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Liste des gerant</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Nom du Gerant</th>
								<th>Contact du Gerant</th>
								<th>Sexe</th>
								<!-- <th>Status</th> -->
							</tr>
						</thead>
						<tbody>
							<?php

                                // afficher le input text losqu'on veut modifier

                                if (isset($_POST['edit'])) {
                                    foreach($gerantliste as $index  => $gerantliste){
                                        echo "<tr>";
                                        if ($gerantliste['ID_GERANT'] == $_POST['num']) {
                                            echo "
												<form method='POST'>
													<td> <input type='text' value='".$gerantliste['NOM_GERANT']."' name='modifnom_gerant'></td>
													<td> <input type='text' value='".$gerantliste['CONTACT_GERANT']."' name='modifsexe_gerant'></td>
													<td> <input type='text' value='".$gerantliste['SEXE']."' name='modifcontact_gerant'></td>
													<td colspan='2'> 
															<input type='hidden' value='".$gerantliste['ID_GERANT']."' name='num'>
															<input type='submit' name='edit2' value='enregistrer'>
													</td>
												</form> 
                                            ";
                                            //affichage normal
                                        }else{
                                            echo "
                                                    <td>".$gerantliste['NOM_GERANT']."</td>
                                                    <td>".$gerantliste['CONTACT_GERANT']."</td>
                                                    <td>".$gerantliste['SEXE']."</td>
                                                    <td> 
                                                        <form method='POST'>
                                                            <input type='hidden' value='".$gerantliste['ID_GERANT']."' name='num'>
                                                            <input type='submit' name='edit' value='modifier' > 
                                                        </form> 
                                                    </td>
                                                    <td> 
                                                        <form method='POST'>
                                                            <input type='hidden' value='".$gerantliste['ID_GERANT']."' name='num'>
                                                            <input type='submit' name='delete' value='supprimer'> 
                                                        </form> 
                                                    </td>
                                                </tr>"
                                            ;
                                        }
                                    }                        
                                }else{
                                    foreach($gerantliste as $index  => $gerantliste){
                                    
                                        echo "
                                        <tr>
                                            <td>".$gerantliste['NOM_GERANT']."</td>
                                            <td>".$gerantliste['CONTACT_GERANT']."</td>
                                            <td>".$gerantliste['SEXE']."</td>
                                            <td> 
                                                <form method='POST'>
                                                    <input type='hidden' value='".$gerantliste['ID_GERANT']."' name='num'>
                                                    <input type='submit' name='edit' value='modifier' > 
                                                </form> 
                                            </td>
                                            <td> 
                                                <form method='POST'>
                                                    <input type='hidden' value='".$gerantliste['ID_GERANT']."' name='num'>
                                                    <input type='submit' name='delete' value='supprimer'> 
                                                </form> 
                                            </td>
                                        </tr>"
                                        ;
                                    }
                                }
                            ?>
						</tbody>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="asset/js/script.js"></script>
</body>
</html>