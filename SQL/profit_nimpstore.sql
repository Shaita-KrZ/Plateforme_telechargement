SELECT SUM(CA_2.CA_app + CA_1.CA_res + coalesce(CA_3.CA_Ab,0))*0.3 AS CA
FROM Editeur E
LEFT OUTER JOIN
(
	SELECT sum(R.prix) as CA_res, E.nom as Nom
	FROM Editeur E, Transaction T, Ressource R, Achat_simple_ressource ASR
	WHERE R.editeur = E.id
	AND ASR.ressource = R.nom
	AND ASR.achat = T.id
	GROUP BY E.nom
	ORDER BY CA_res DESC
) AS CA_1
ON E.nom = CA_1.Nom
LEFT OUTER JOIN 
(
	SELECT sum(A.prix) as CA_app, E.nom as Nom
	FROM Editeur E, Application A, Achat_simple_app ASA, Transaction T 
	WHERE A.editeur = E.id
	AND ASA.achat = T.id
	AND ASA.app = A.nom
	GROUP BY E.nom
	ORDER BY CA_app DESC
) AS CA_2
ON E.nom = CA_2.Nom
LEFT OUTER JOIN
(
	SELECT SUM(Ab.prixabonnement*Ab.nbmois) AS CA_Ab, E.nom as Nom
	FROM Abonnement Ab, application A, Editeur E, Transaction T
	WHERE Ab.app = A.Nom
	AND T.id = Ab.achat
	AND A.editeur = E.id
	GROUP BY E.nom
	ORDER BY CA_Ab DESC
) AS CA_3
ON E.nom = CA_3.nom;
