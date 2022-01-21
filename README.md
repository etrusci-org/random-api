# random-api

Work in progress.

---

## Endpoint

Every request begins with this URL. If no node, options or flags are set, this returns one random node item.

```text
https://etrusci.org/random/api.php
```

You can select a node and add options through the query string variable `r` like so:

```text
api.php?r=[node][/options][/flags]
```

You can send requests as both `GET` and `POST`. The API looks in the query variable `r` for the request string.

---

## Nodes

Nodes define the data source. They always come first in the query string and thus are required if you want to set **options** or **flags**. Available nodes are:

- **names:** Entity names.
- **primes:** Prime numbers.
- **pseudohash16:** Pseudo hashes of length 16.
- **pseudohash32:** Pseudo hashes of length 32.
- **pseudohash64:** Pseudo hashes of length 64.

**Example:**

```text
api.php?r=names
```

---

## Options

All nodes accept the same options. You can not have them without having a node set. They are always `key:value` pairs. Available options:

- **count:** How many items to return. Valid values are numbers in the range `1 - 10`.

**Example:**

```text
api.php?r=names/count:3
```

---

## Flags

Flags are single values that can toggle something on or off.

- **noid:** Omit the `id` value from the response data.

**Example:**

```text
api.php?r=names/count:3/noid
```

---

## Response

The response comes as [JSON](https://json.org).

Example:

```curl
api.php?r=primes/count:3/noid
```

```json
{
    "time": 1642724052.271752,
    "request": "primes/count:3/noid",
    "errors": [],
    "data": [
        {
            "val": 37691
        },
        {
            "val": 58193
        },
        {
            "val": 66161
        }
    ]
}
```

If anything goes wrong, the `error` array will have items in it and `data` will be empty.

```json
{
    "time": 1642724034.089665,
    "request": "boo/noid",
    "errors": [
        "Invalid node: boo"
    ],
    "data": []
}
```

---
