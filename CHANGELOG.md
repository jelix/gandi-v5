# Changelog

# 1.0.0

Update dependencies.

# 0.2.5

Fix autoload into the gandi script

# 0.2.4

- some bug fix
- `LiveDNS::createOrUpdateRecord` update only if the given record is different
  from the existing record

# 0.2.3

- new method `LiveDns::createRecordIfNotExists()`
- Fix command OrganizationList to be compatible with Symphony Console

# 0.2.2

- new method `LiveDns::getRecord()`
- The `livedns:record:create`  command check now if the record already exists or not

# 0.2.1

- Fix `LiveDNS::createOrUpdateRecord`
- New command `livedns:record:delete`

# 0.2.0

- LiveDns: new methods `createOrUpdateRecord`, `updateRecord`, `deleteRecord`
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
