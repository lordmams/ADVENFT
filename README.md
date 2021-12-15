# ADVENFT

## Routes

### Liste des calendriers

Route : `/api/calendar`

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

Route : `/api/calendar/new`

Data à transmettre :

```json
{
    title: "Le titre du calendrier",
    eventId: "1",
    hasDonation: "1"
}
```
