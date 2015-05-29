SELECT E.nom AS Editeur, COALESCE(NB_1.nb_res,0) as res, COALESCE(NB_2.nb_app,0) as app, COALESCE(NB_3.nb_ab,0) as abonnement, SUM(NB_2.nb_app + NB_1.nb_res + COALESCE(NB_3.nb_ab,0)) as total
FROM Editeur E
LEFT OUTER JOIN
(
	SELECT COUNT(*) as nb_res, E.nom as Nom
	FROM Editeur E, Transaction T, Ressource R, Achat_simple_ressource ASR
	WHERE R.editeur = E.id
	AND ASR.ressource = R.nom
	AND ASR.achat = T.id
	GROUP BY E.nom
	ORDER BY nb_res DESC
) AS NB_1
ON E.nom = NB_1.Nom
LEFT OUTER JOIN 
(
	SELECT COUNT(*) as nb_app, E.nom as Nom
	FROM Editeur E, Application A, Achat_simple_app ASA, Transaction T 
	WHERE A.editeur = E.id
	AND ASA.achat = T.id
	AND ASA.app = A.nom
	GROUP BY E.nom
	ORDER BY nb_app DESC
) AS NB_2
ON E.nom = NB_2.Nom
LEFT OUTER JOIN
(
	SELECT COUNT(*) AS nb_ab, E.nom as Nom
	FROM Abonnement Ab, application A, Editeur E, Transaction T
	WHERE Ab.app = A.Nom
	AND T.id = Ab.achat
	AND A.editeur = E.id
	GROUP BY E.nom
	ORDER BY nb_ab DESC
) AS NB_3
ON E.nom = NB_3.nom
GROUP BY E.nom, NB_1.nb_res, NB_2.nb_app, NB_3.nb_ab
ORDER BY total DESC;
