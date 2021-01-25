# Authentification Back-office

1. Page de connexion => formulaire avec email + password, en POST
2. vérification user valide => récupération des data despuis la table app_user
3. si ok, on conserve l'état connecté => stocker l'objet `User` en session (`$_SESSION['conectedUser'] = ...` par exemple)
4. si erreur => tableau $errorsList transmis à la vue