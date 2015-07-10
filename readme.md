## Redirects.in

This app unpacks redirects in URLs. Just paste the URL you want to unpack after the app url (e.g. `http://app.url/http://jbl.me/breadcrumbs`). If there's no protocol on the url to unpack, it will default to `http:`.

You may also send the request with `'application/json'` as the `Accept` header to get a json response with the following format:

```json
{
  "start": "start url",
  "end": "final url",
  "steps": [
    "each",
    "step",
    "between",
    "start",
    "and",
    "end"
  ]
}
```

### License

Redirects.in is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
