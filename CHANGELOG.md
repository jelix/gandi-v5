# Changelog


# next

- LiveDNS: new methods `createRecordIfNotExists`, `createOrUpdateRecord`, `updateRecord`, `deleteRecord`
- Use Symphony Console 5.2.*
- API CHANGE: `Status::getCurrentStatus()` returns now an array. The status web API of Gandi has changed.
- Fix exceptions management
- Fix a parameter issue into `ZoneRecord::createFromApi()`

# 0.1.0

First release.

- commands to list domains, list records of a domain, create a record
- API for LiveDNS: domains list, records list, record creation
- API to list organizations
- API to get status of Gandi API
