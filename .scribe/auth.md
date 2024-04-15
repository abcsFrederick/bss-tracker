# Authenticating requests

To authenticate requests, include a query parameter **`key`** in the request.

You may also (in place of the **`key`** query parameter) include an **`X-API-Token`** header in your request to authenticate.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

You can retrieve your token by visiting the <b>API Keys</b> in the administration section and clicking <b>Create API token</b>.
