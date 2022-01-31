# random-api

Retrieve curated random data.

If you just want to read some random data, go to <https://etrusci.org/tool/random-api>. For accessing the API programmatically, read below.

- [Endpoint](#endpoint)
- [Parameters](#parameters)
  - [Syntax](#syntax)
  - [Nodes](#nodes)
  - [Vars](#vars)
  - [Flags](#flags)
- [Response](#response)
- [Rate Limits](#rate-limits)
- [License](#license)

---

## Endpoint

Every request begins with this URL. You can send requests as both `GET` or `POST`.

```text
https://etrusci.org/tool/random-api/api.php?r=
```

For simplicity, this is shortened to just `api.php?r=` in the following texts.

---

## Parameters

If you set no parameters, the API will return one random item from a random **node**.

**Nodes** always come first in the query string and thus are required if you want to also set **vars** or **flags**.

### Syntax

**Nodes**, **vars** and **flags** are always separated with `/`.

```text
api.php?r=[node][/vars][/flags]
```

### Nodes

| Node              | Description                |
|-------------------|----------------------------|
| names             | Entity names               |
| primes            | Prime numbers              |
| pseudohashes16    | Pseudo hashes of length 16 |
| pseudohashes32    | Pseudo hashes of length 32 |
| pseudohashes64    | Pseudo hashes of length 64 |
| pseudoyoutubeids  | Pseudo YouTube video IDs   |
| pseudoyoutubeurls | Pseudo YouTube video URLs  |
| triangulars       | Triangular numbers         |

Examples:

```text
api.php?r=names
api.php?r=primes
api.php?r=pseudohashes16
```

### Vars

| Var   | Description                 | Valid Values | Default |
|-------|-----------------------------|--------------|---------|
| count | number of items to return   | `1` - `10`   | `1`     |

Examples:

```text
api.php?r=names/count:10
api.php?r=primes/count:7
api.php?r=pseudohashes16/count:3
```

### Flags

| Flag | Description                            |
|------|----------------------------------------|
| noid | Ommit the item ID in the response data |

Examples:

```text
api.php?r=names/count:10/noid
api.php?r=primes/count:7/noid
api.php?r=pseudohashes16/count:3/noid
```

---

## Response

The response comes as [JSON](https://json.org). What you want is in the `data` array.

Example:

```json
// GET api.php?r=names/count:3
{
    "version": "1.1.0",
    "time": 1643639966,
    "request": "names/count:3",
    "errors": [],
    "data": [
        {
            "id": 19180,
            "val": "Copulating Leslie Bartles"
        },
        {
            "id": 29818,
            "val": "Elberta Mosiman"
        },
        {
            "id": 52918,
            "val": "Kathryn Hazekamp Of Forksville"
        }
    ]
}
```

If anything goes wrong, the `error` array should have items in it and `data` will be empty.

Example:

```json
// GET api.php?r=count:3
{
    "version": "1.1.0",
    "time": 1643639784,
    "request": "count:3",
    "errors": [
        "Invalid node: count:3"
    ],
    "data": []
}
```

---

## Rate Limits

- Maximum 100 requests per 3600 seconds.
- Minimum 1 second delay between requests.

---

[LICENSE](LICENSE.md)
