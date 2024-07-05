<?php 
require("action/categorie/affichecategorie.php");
require("action/categorie/registercategorie.php"); 
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
			<li class="active">
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
					<h1>Categorie</h1>
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
                            <input type="text" name="nom_categorie" id="">
                            <p>Nom categorie</p>
                        </span>
                    </li>
                    <li>
                        <span class="text">
                            <textarea name="description_categorie" id=""></textarea>
                            <p>Description categorie</p>
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
						<h3>Liste des categorie</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Nom de la categorie</th>
								<!-- <th>Status</th> -->
							</tr>
						</thead>
						<tbody>
							<?php

                                // afficher le input text losqu'on veut modifier

                                if (isset($_POST['edit'])) {
                                    foreach($categorieliste as $index  => $categorieliste){
                                        echo "<tr>";
                                        if ($categorieliste['ID_CATEGORIE'] == $_POST['num']) {
                                            echo "
												<form method='POST'>
													<td> <input type='text' value='".$categorieliste['NOM_CATEGORIE']."' name='modifnom_categorie'></td>
													<td colspan='2'> 
															<input type='hidden' value='".$categorieliste['ID_CATEGORIE']."' name='num'>
															<input type='submit' name='edit2' value='enregistrer'>
													</td>
												</form> 
                                            ";
                                            //affichage normal
                                        }else{
                                            echo "
                                                    <td>".$categorieliste['NOM_CATEGORIE']."</td>
                                                    <td> 
                                                        <form method='POST'>
                                                            <input type='hidden' value='".$categorieliste['ID_CATEGORIE']."' name='num'>
                                                            <input type='submit' name='edit' value='modifier' > 
                                                        </form> 
                                                    </td>
                                                    <td> 
                                                        <form method='POST'>
                                                            <input type='hidden' value='".$categorieliste['ID_CATEGORIE']."' name='num'>
                                                            <input type='submit' name='delete' value='supprimer'> 
                                                        </form> 
                                                    </td>
                                                </tr>"
                                            ;
                                        }
                                    }                        
                                }else{
                                    foreach($categorieliste as $index  => $categorieliste){
                                    
                                        echo "
                                        <tr>
                                            <td>".$categorieliste['NOM_CATEGORIE']."</td>
                                            <td> 
                                                <form method='POST'>
                                                    <input type='hidden' value='".$categorieliste['ID_CATEGORIE']."' name='num'>
                                                    <input type='submit' name='edit' value='modifier' > 
                                                </form> 
                                            </td>
                                            <td> 
                                                <form method='POST'>
                                                    <input type='hidden' value='".$categorieliste['ID_CATEGORIE']."' name='num'>
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


</body>
</html>