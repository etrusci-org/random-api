# random-api

Retrieve curated random data.

If you just want to read some random data, go to <https://etrusci.org/tool/random-api>. For accessing the API programmatically, read the [Usage](#usage) section.

---

- [Usage](#usage)
  - [Endpoint](#endpoint)
  - [Request Syntax](#request-syntax)
  - [Nodes](#nodes)
  - [Vars](#vars)
  - [Flags](#flags)
  - [Response](#response)
  - [Rate Limits](#rate-limits)
- [License](#license)

---

## Usage

### Endpoint

Every request begins with this URL. By default this returns one random item from a random **node**. You can send requests as both `GET` or `POST`.

```text
https://etrusci.org/tool/random-api/api.php?r=
```

For simplicity, this is shortened to just `api.php?r=` in the following texts.

### Request Syntax

**Nodes**, **vars** and **flags** are always separated with `/`.

```text
api.php?r=[node][/vars][/flags]
```

### Nodes

**Nodes** define the data source. They always come first in the query string and thus are required if you want to set **vars** or **flags**.

Available:

- **names:** Entity names.
- **primes:** Prime numbers.
- **pseudohashes16:** Pseudo hashes of length 16.
- **pseudohashes32:** Pseudo hashes of length 32.
- **pseudohashes64:** Pseudo hashes of length 64.
- **pseudoyoutubeids:** Pseudo YouTube video IDs.
- **pseudoyoutubeurls:** Pseudo YouTube video URLs.
- **triangulars:** Triangular numbers.

Examples:

```text
api.php?r=names
api.php?r=primes
api.php?r=pseudohashes16
```

### Vars

All **nodes** accept the same **vars**. You can not have them without having a **node** set. They are always `key:value` pairs.

Available:

- **count:** How many items to return. Valid values are numbers in the range `1 - 10`.

Examples:

```text
api.php?r=names/count:3
api.php?r=primes/count:7
api.php?r=pseudohashes16/count:3
```

### Flags

**Flags** are single values that can toggle something on or off.

Available:

- **noid:** Omit the `id` value from the response data.

Example:

```text
api.php?r=names/count:3/noid
api.php?r=primes/count:7/noid
api.php?r=pseudohashes16/count:3/noid
```

### Response

The response comes as [JSON](https://json.org). What you want is in the `data` array.

Example:

```json
{
    "version": "1.0.0",
    "time": 1642967510,
    "request": "primes/count:3",
    "errors": [],
    "data": [
        {
            "id": 12554,
            "val": 134699
        },
        {
            "id": 27776,
            "val": 322073
        },
        {
            "id": 31546,
            "val": 370373
        }
    ]
}
```

If anything goes wrong, the `error` array will have items in it and `data` will be empty.

Example:

```json
{
    "version": "1.0.0",
    "time": 1642967630,
    "request": "boo/count:3",
    "errors": [
        "Invalid node: boo"
    ],
    "data": []
}
```

### Rate Limits

- Maximum 100 requests per 3600 seconds.
- Minimum 1 second delay between requests.

---

## License

Code + Data: Public Domain Worldwide

---
