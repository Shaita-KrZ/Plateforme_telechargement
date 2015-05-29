SELECT A.nom AS nom, CA_1.CA_Ventes AS Ventes , CA_2.CA_Ab AS Abonnement
FROM application A 
LEFT OUTER JOIN 
(
	SELECT Achat.app AS Nom, SUM(A.prix) AS CA_Ventes
	FROM achat_simple_app Achat, application A
	WHERE Achat.app = A.Nom
	GROUP BY Achat.app
	ORDER BY CA_Ventes DESC
) AS CA_1
ON A.nom = CA_1.Nom
LEFT OUTER JOIN 
(
	SELECT Ab.app AS Nom, SUM(Ab.prixabonnement*Ab.nbmois) AS CA_Ab
	FROM abonnement Ab, application A
	WHERE Ab.app = A.Nom
	GROUP BY Ab.app
	ORDER BY CA_Ab DESC
) AS CA_2
ON A.nom = CA_2.Nom;