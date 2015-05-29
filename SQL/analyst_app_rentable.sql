SELECT A.nom AS nom, COALESCE(CA_1.CA_Ventes,0) AS Ventes , COALESCE(CA_2.CA_Ab,0) AS Abonnement, SUM(COALESCE(CA_1.CA_Ventes,0)+COALESCE(CA_2.CA_Ab,0)) AS total
FROM application A 
LEFT OUTER JOIN 
(
	SELECT Achat.app AS Nom, COALESCE(SUM(A.prix)) AS CA_Ventes
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
ON A.nom = CA_2.Nom
GROUP BY A.nom,CA_1.CA_Ventes, CA_2.CA_Ab 
ORDER BY total DESC;
