<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Choisir un objectif</title>
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
		crossorigin="anonymous" />
	<style>
		body {
			background: #f6f8fb;
		}

		.objectif-card {
			cursor: pointer;
			border: 2px solid #e6e9ef;
			transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
		}

		.btn-check:checked+.objectif-card {
			border-color: #0d6efd;
			box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
			transform: translateY(-2px);
		}

		.objectif-card .card-title {
			font-weight: 600;
		}
	</style>
</head>

<body>
	<main class="container py-5">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="d-flex justify-content-between align-items-center mb-4">
					<div>
						<h1 class="h3 mb-1">Choisissez votre objectif</h1>
						<p class="text-muted mb-0">Selectionnez un objectif pour personnaliser votre parcours.</p>
					</div>
				</div>

				<?php $user = session()->get('user'); ?>

				<?php if (empty($objectifs)) : ?>
					<div class="alert alert-warning" role="alert">
						Aucun objectif disponible pour le moment.
					</div>
				<?php else : ?>
					<form action="/objectif/save" method="post" class="card shadow-sm border-0">
						<div class="card-body">
							<?= csrf_field() ?>

							<?php if (!empty($user) && isset($user['id'])) : ?>
								<input type="hidden" name="user_id" value="<?= esc($user['id']) ?>" />
							<?php else : ?>
								<div class="alert alert-info" role="alert">
									Connectez-vous pour enregistrer votre choix.
								</div>
							<?php endif; ?>

							<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
								<?php foreach ($objectifs as $objectif) : ?>
									<?php $objectifId = esc($objectif['id']); ?>
									<?php $objectifNom = esc($objectif['objectif']); ?>
									<?php $objectifDescription = trim($objectif['description'] ?? ''); ?>

									<div class="col">
										<input
											class="btn-check"
											type="radio"
											name="objectif_id"
											id="objectif-<?= $objectifId ?>"
											value="<?= $objectifId ?>"
											autocomplete="off" />
										<label class="card objectif-card h-100" for="objectif-<?= $objectifId ?>">
											<div class="card-body">
												<div class="d-flex align-items-start justify-content-between mb-2">
													<h5 class="card-title mb-0"><?= $objectifNom ?></h5>
													<span class="badge text-bg-primary">Objectif</span>
												</div>
												<p class="card-text text-muted">
													<?= $objectifDescription !== '' ? esc($objectifDescription) : 'Aucune description disponible.' ?>
												</p>
												<div class="form-check mt-3">
													<input class="form-check-input" type="radio" disabled />
													<label class="form-check-label text-muted">
														Selectionner cet objectif
													</label>
												</div>
											</div>
										</label>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
							<a href="/" class="btn btn-outline-secondary">Retour</a>
							<button type="submit" class="btn btn-primary">Confirmer la selection</button>
						</div>
					</form>
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
