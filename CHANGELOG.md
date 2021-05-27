# Changelog


# next

- LiveDNS: new methods `createOrUpdateRecord`, `updateRecord`, `deleteRecord`
- API CHANGE: `Status::getCurrentStatus()` returns now an array. The status web API of Gandi has changed.
- Requirements: PHP minimum version is now 7.2.5.
- Upgrade Symphony Console to `5.2.*` and GuzzleHttp to `7.3.*`
- Fix exceptions management
- Fix a parameter issue into `ZoneRecord::createFromApi()`

# 0.1.0

First release.

- commands to list domains, list records of a domain, create a record
- API for LiveDNS: domains list, records list, record creation
- API to list organizations
- API to get status of Gandi API
