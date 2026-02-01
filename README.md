# Site Claudia Maftei

## Tests manuels (acceptation)

1. **Soumission OK** : envoyer le formulaire avec des champs valides et vérifier la redirection vers `index.html?status=success#contact` ainsi que l’affichage du message de succès.
2. **Email invalide** : envoyer le formulaire avec un email invalide et vérifier la redirection vers `index.html?status=invalid#contact` ainsi que l’affichage du message d’erreur.
3. **Honeypot** : remplir le champ caché `website` et vérifier la redirection vers `index.html?status=spam#contact` ainsi que l’affichage du message d’erreur.
4. **Méthode GET** : appeler `contact.php` en GET et vérifier un retour HTTP 405 (ou une redirection d’erreur sans information sensible).
5. **robots.txt** : vérifier l’accès à `https://claudia-maftei.com/robots.txt`.
6. **sitemap.xml** : vérifier l’accès à `https://claudia-maftei.com/sitemap.xml` et la présence de toutes les URLs attendues.
7. **Lighthouse** : lancer un audit Lighthouse et vérifier qu’il n’y a pas de régression évidente (performance, SEO, accessibilité).
