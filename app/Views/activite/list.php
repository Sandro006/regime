<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Activites sportives</title>
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
		crossorigin="anonymous" />
</head>

<body>
	<main class="container py-5">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
					<div>
						<h1 class="h3 mb-1">Activites sportives</h1>
						<p class="text-muted mb-0">Liste des activites disponibles.</p>
					</div>
					<?php if (!empty($objectif)) : ?>
						<span class="badge text-bg-primary">Objectif: <?= esc($objectif) ?></span>
					<?php endif; ?>
				</div>

				<?php if (!empty($info)) : ?>
					<div class="alert alert-info" role="alert">
						<?= esc($info) ?>
					</div>
				<?php endif; ?>

				<?php if (empty($activites)) : ?>
					<div class="alert alert-warning" role="alert">
						Aucune activite disponible pour le moment.
					</div>
				<?php else : ?>
					<div class="card shadow-sm border-0">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped align-middle mb-0">
									<thead>
										<tr>
											<th>Nom</th>
											<th>Niveau</th>
											<th>Calories</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($activites as $activite) : ?>
											<?php
											$nom = $activite['nom'] ?? $activite['nom_activite'] ?? 'Activite';
											$niveau = $activite['niveau'] ?? $activite['niveau_difficulte'] ?? 'n/a';
											$calories = $activite['calories'] ?? $activite['calories_brulees'] ?? 'n/a';
											$description = $activite['description'] ?? '';
											?>
											<tr>
												<td class="fw-semibold"><?= esc($nom) ?></td>
												<td><?= esc($niveau) ?></td>
												<td><?= esc($calories) ?></td>
												<td class="text-muted">
													<?= $description !== '' ? esc($description) : 'Aucune description.' ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</main>
	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
</body>

</html>
