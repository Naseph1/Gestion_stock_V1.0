<?php 
    require("action/produit/afficheproduit.php"); 
    require("action/produit/registerproduit.php");
	require("action/securityaction.php");
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
			<li class="active">
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

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Produits</h1>
					
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
                            <p>quantite</p>
                        </span>
                    </li>
					<li>
                        <span class="text">

							<!-- liste des fournisseur pour le select -->

							<select name="nom_fournisseur">
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

								<!-- liste des categorie pour le select -->

							<select name="categorie_produit">
								<option></option>
								<?php 
									foreach($categorieliste as $index => $categorieliste){
										echo"<option>".$categorieliste['NOM_CATEGORIE']."</option>";
									}
								?>
							</select>

                            <p>categorie du produit</p>
                        </span>
                    </li>
					<li>
                        <span class="text">
                            <input type="date" name="datelivraison" id="">
                            <p>date de livraison</p>
                        </span>
                    </li>
					<li>
                        <span class="text">
                            <input type="date" name="dateperemption" id="">
                            <p>date de peremption</p>
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
						<h3>Liste des produits</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Nom du produit</th>
								<th>Prix produit</th>
								<th>Quantite produit</th>
								<th>Fournisseur</th>
								<th>Date de livraison</th>
								<th>Date de peremption</th>
								<!-- <th>Status</th> -->
							</tr>
						</thead>
						<tbody>
							<?php

                                // afficher le input text losqu'on veut modifier

                                if (isset($_POST['edit'])) {
                                    foreach($produitliste as $index  => $produitliste){
                                        echo "<tr>";
                                        if ($produitliste['ID_PRODUIT'] == $_POST['num']) {
                                            echo "
												<form method='POST'>
													<td> <input type='text' value='".$produitliste['NOM_PRODUIT']."' name='modifnom_fournisseur'></td>
													<td> <input type='text' value='".$produitliste['PRIX_PRODUIT']."' name='modifnom_fournisseur'></td>
													<td> <input type='text' value='".$produitliste['QUANTITE_PRODUIT']."' name='modifcontact_fournisseur'></td>
													<td> <input type='text' value='".$produitliste['FOURNISSEUR']."' name='modifcontact_fournisseur'></td>
													<td> <input type='text' value='".$produitliste['DATE_LIVRAISON_PRODUIT']."' name='modifcontact_fournisseur'></td>
													<td> <input type='text' value='".$produitliste['DATE_PEREMPTION_PRODUIT']."' name='modifcontact_fournisseur'></td>
													<td colspan='2'> 
															<input type='hidden' value='".$produitliste['ID_PRODUIT']."' name='num'>
															<input type='submit' name='edit2' value='enregistrer'>
													</td>
												</form> 
                                            ";
                                            //affichage normal
                                        }else{
                                            echo "
													<td>".$produitliste['NOM_PRODUIT']."</td>
													<td>".$produitliste['PRIX_PRODUIT']."</td>
													<td>".$produitliste['QUANTITE_PRODUIT']."</td>
													<td>".$produitliste['FOURNISSEUR']."</td>
													<td>".$produitliste['DATE_LIVRAISON_PRODUIT']."</td>
													<td>".$produitliste['DATE_PEREMPTION_PRODUIT']."</td>
                                                    <td> 
                                                        <form method='POST'>
                                                            <input type='hidden' value='".$produitliste['ID_PRODUIT']."' name='num'>
                                                            <input type='submit' name='edit' value='modifier' > 
                                                        </form> 
                                                    </td>
                                                    <td> 
                                                        <form method='POST'>
                                                            <input type='hidden' value='".$produitliste['ID_PRODUIT']."' name='num'>
                                                            <input type='submit' name='delete' value='supprimer'> 
                                                        </form> 
                                                    </td>
                                                </tr>"
                                            ;
                                        }
                                    }                        
                                }else{
                                    foreach($produitliste as $index  => $produitliste){
                                    
                                        echo"
												<td>".$produitliste['NOM_PRODUIT']."</td>
												<td>".$produitliste['PRIX_PRODUIT']."</td>
												<td>".$produitliste['QUANTITE_PRODUIT']."</td>
												<td>".$produitliste['FOURNISSEUR']."</td>
												<td>".$produitliste['DATE_LIVRAISON_PRODUIT']."</td>
												<td>".$produitliste['DATE_PEREMPTION_PRODUIT']."</td>
                                                <td> 
                                                    <form method='POST'>
                                                        <input type='hidden' value='".$produitliste['ID_PRODUIT']."' name='num'>
                                                        <input type='submit' name='edit' value='modifier' > 
                                                    </form> 
                                                </td>
                                                <td> 
                                                    <form method='POST'>
                                                        <input type='hidden' value='".$produitliste['ID_PRODUIT']."' name='num'>
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