# random-api

Work in progress.

---

## Endpoint

Every request begins with this URL. By default this returns one random item from a random **node**. You can send requests as both `GET` or `POST`.

```text
https://etrusci.org/random/api.php?r=
```

## Usage

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
- **pseudohash16:** Pseudo hashes of length 16.
- **pseudohash32:** Pseudo hashes of length 32.
- **pseudohash64:** Pseudo hashes of length 64.
- **triangulars:** Triangular numbers.

Example:

```text
api.php?r=names
```

### Vars

All **nodes** accept the same **vars**. You can not have them without having a **node** set. They are always `key:value` pairs.

Available:

- **count:** How many items to return. Valid values are numbers in the range `1 - 10`.

Example:

```text
api.php?r=names/count:3
```

### Flags

**Flags** are single values that can toggle something on or off.

- **noid:** Omit the `id` value from the response data.

Example:

```text
api.php?r=names/noid
```

### Response

The response comes as [JSON](https://json.org).

Example:

```json
{
    "time": 1642784073,
    "request": "primes/count:3/noid",
    "errors": [],
    "data": [
        {
            "val": 546781
        },
        {
            "val": 950953
        },
        {
            "val": 993283
        }
    ]
}
```

If anything goes wrong, the `error` array will have items in it and `data` will be empty.

```json
{
    "time": 1642784103,
    "request": "boo/count:3",
    "errors": [
        "Invalid node: boo"
    ],
    "data": []
}
```

---
