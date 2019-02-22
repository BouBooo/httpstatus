# httpstatus_API

## A propos
 * Langages : PHP, SQL
 * Framework : Descartes
 * Base de données : MariaDB
 * Environnement : Linux (Ubuntu)
 
 
 ## Site
 
 
 Admin : Peut ajouter un site, le modifier, le supprimer ou consulter son historique 
 Visiteur : Peut consulter l'historique de chaque site
 
 
 
## API

Le site possède une API qui permet de :

- Lister les sites
```
{
    'version': 1,
    'list': 'http://example.fr/httpstatus/api/list/'
}
```


- Ajouter un site
```
{
    'success': true,
    'id': 7269,
}
```

- Supprimer un site
```
{
    'success': true,
    'id': 7269,
}
```

- Consulter le statut actuel d'un site
```
{
    'id': 973,
    'url': 'http://toto.com',
    'status': {
        'code': 200,
        'at': '2019-02-01 10:00:12'
    }
}
```

- Consulter l'historique d'un site
```
{
    'id': 973,
    'url': 'http://toto.com',
    'status': [
        {
            'code': 200,
            'at': '2019-01-10 10:00:11'
        },
        {
            'code': 500,
            'at': '2019-01-10 09:58:11'
        },
        {
            'code': 200,
            'at': '2019-01-10 09:56:11'
        },
    ]
}
```
