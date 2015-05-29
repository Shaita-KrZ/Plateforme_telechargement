SELECT sum(A.prix + R.prix as CA), nom as Nom
FROM Editeur E, Application A, Ressource R, Achat_simple_ressource ASR, Achat_simple_app ASA
WHERE A.editeur = E.id
AND R.editeur = E.id
AND ASR.ressource = R.nom
AND ASA.achat = T.id