# ADVENFT

## Routes

### Liste des calendriers

Route : `GET /api/calendar`

Data :

```json
[
    {
      "id": 10,
      "title": "Calendrier de l'avent #9",
      "user": {
        "id": 2,
        "email": "test@test.com"
      },
      "hasDonation": true,
      "event": {
        "id": 1,
        "title": "Noël",
        "startDate": "2021-12-01T00:00:00+00:00",
        "endDate": "2021-12-24T00:00:00+00:00"
      }
    },
    {
      "id": 11,
      "title": "Calendrier de l'avent #10",
      "user": {
        "id": 2,
        "email": "test@test.com"
      },
      "hasDonation": true,
      "event": {
        "id": 1,
        "title": "Noël",
        "startDate": "2021-12-01T00:00:00+00:00",
        "endDate": "2021-12-24T00:00:00+00:00"
      }
    }
]
```

### Créer un calendrier

Route : `POST /api/calendar/new`

Data à transmettre :

```json
{
    "title": "Le titre du calendrier",
    "event": "1",
    "hasDonation": "1"
}
```

### Éditer un calendrier

Route : `PATCH /api/calendar/{id}/edit`

Data à transmettre :

```json
{
    "title": "Le titre du calendrier",
    "event": "1",
    "hasDonation": "1"
}
```

### Supprimer un calendrier

Route : `DELETE /api/calendar/{id}/edit`


### Évènement

-Liste des évènements : `/api/event/list`
-Crée un évènement : `/api/event/new` 
Data à transmettre:
```json{
    "title": "Le titre du calendrier",
    "startDate": "date",
    "endDate": "date"
}
```

