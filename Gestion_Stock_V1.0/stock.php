<?php 
// session_start();
require("action/stock/affichestock.php"); 
require("action/stock/registerstock.php"); 
require("action/securityaction.php");
?>

<!DOCTYPE html>
<html lang="en">
<?php require("include/head.php"); ?>
<body>
	<style>
		td input{
			width: 100%;
			text-align: center;
		}
	</style>


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
			<li class="active">
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
					<li>
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

		<!------------------------------------- MAIN ------------------------------------->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Stock    </h1>
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
                            <input type="text" name="nom_produit" id="">
                            <p>Nom Produit</p>
                        </span>
                    </li>
                    <li>
                        <span class="text">
                            <textarea name="description_produit" id=""></textarea>
                            <p>Description du produit</p>
                        </span>
                    </li>
					<li>
                        <span class="text">
                            <input type="text" name="prix_produit" id="">
                            <p>Prix Produit</p>
                        </span>
                    </li>
					<li>
                        <span class="text">
                            <input type="text" name="quantite" id="">
                            <p>Quantite</p>
                        </span>
                    </li>
					<li>
                        <span class="text">

							<!-- liste des fournisseur pour le select -->

							<select name="fournisseur">
								<option value=""></option>
								<?php 
									foreach($fournisseurliste as $index => $fournisseurliste){
										echo"<option>".$fournisseurliste['NOM_FOURNISSEUR']."</option>";
									}
								?>
							</select>
                            <p>Nom du fournisseur</p>
                        </span>
                    </li>
	
					<li>
                        <span class="text">
                            <input type="date" name="dateajout" id="">
                            <p>date d'ajout</p>
                        </span>
                    </li>
					<li>
                        <span class="text">
                            <input type="date" name="dateexpiration" id="">
                            <p>date d'expiration</p>
                        </span>
                    </li>
                    <li>
                        <span class="text">
                            <input type="submit" value="Enregistrer" name="validate">
                        </span>
                    </li>
                </ul>
            </form>

                <!-- liste des stocks  -->

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Liste des produits</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Nom du stock</th>
								<th>Quantite</th>
								<th>Date d'ajout</th>
								<th>Date d'expiration</th>
								<th>Fournisseur</th>
								<th>Prix produit</th>
								<!-- <th>Status</th> -->
							</tr>
						</thead>
						<tbody>
							<?php

                                // afficher le input text losqu'on veut modifier

                                if (isset($_POST['edit'])) {
                                    foreach($stockliste as $index  => $stockliste){
                                        echo "<tr>";
                                        if ($stockliste['ID_STOCK'] == $_POST['num']) {
                                            echo "
												<form method='POST'>
													<td> <input type='text' value='".$stockliste['NOM_PRODUIT']."' name='modifnom_produit'></td>
													<td> <input type='text' value='".$stockliste['QUANTITE_DISPONIBLE']."' name='modifquantite'></td>
													<td> <input type='date' value='".$stockliste['DATE_D_AJOUT']."' name='modifdateajout'></td>
													<td> <input type='date' value='".$stockliste['DATE_D_EXPIRATION']."' name='modifdateexpiration'></td>
													<td> <input type='text' value='".$stockliste['FOURNISSEUR']."' name='modiffournisseur'></td>
													<td> <input type='text' value='".$stockliste['PRIX_PRODUIT']."' name='modifprix_produit'></td>
													
													<td colspan='2'> 
															<input type='hidden' value='".$stockliste['ID_STOCK']."' name='num'>
															<input type='submit' name='edit2' value='enregistrer'>
													</td>
												</form> 
                                            ";

                                            //affichage normal
                                        
										}else{
                                            echo "
													<td>".$stockliste['NOM_PRODUIT']."</td>
													<td>".$stockliste['QUANTITE_DISPONIBLE']."</td>
													<td>".$stockliste['DATE_D_AJOUT']."</td>
													<td>".$stockliste['DATE_D_EXPIRATION']."</td>
													<td>".$stockliste['FOURNISSEUR']."</td>
													<td>".$stockliste['PRIX_PRODUIT']."</td>
													
                                                    <td> 
                                                        <form method='POST'>
                                                            <input type='hidden' value='".$stockliste['ID_STOCK']."' name='num'>
                                                            <input type='submit' name='edit' value='modifier' > 
                                                        </form> 
                                                    </td>
                                                    <td> 
                                                        <form method='POST'>
                                                            <input type='hidden' value='".$stockliste['ID_STOCK']."' name='num'>
                                                            <input type='submit' name='delete' value='supprimer'> 
                                                        </form> 
                                                    </td>
                                                </tr>"
                                            ;
                                        }
                                    }                        
                                }else{
                                    foreach($stockliste as $index  => $stockliste){
                                    
                                        echo"
												<td>".$stockliste['NOM_PRODUIT']."</td>
												<td>".$stockliste['QUANTITE_DISPONIBLE']."</td>
												<td>".$stockliste['DATE_D_AJOUT']."</td>
												<td>".$stockliste['DATE_D_EXPIRATION']."</td>
												<td>".$stockliste['FOURNISSEUR']."</td>
												<td>".$stockliste['PRIX_PRODUIT']."</td>
												
                                                <td> 
                                                    <form method='POST'>
                                                        <input type='hidden' value='".$stockliste['ID_STOCK']."' name='num'>
                                                        <input type='submit' name='edit' value='modifier' > 
                                                    </form> 
                                                </td>
                                                <td> 
                                                    <form method='POST'>
                                                        <input type='hidden' value='".$stockliste['ID_STOCK']."' name='num'>
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
		<!---------------------------------- MAIN ---------------------------->
	</section>
	<!-- CONTENT -->
	

	<script src="asset/js/script.js"></script>
</body>
</html>