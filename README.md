
Library and command line to use the Gandi V5 API.

See Documentation reference of the Gandi V5 API: https://api.gandi.net/docs/

This library is not developed and maintained by Gandi.

Using CLI commands
==================

Requirements
-------------

You must have PHP 7.1+.

Api key
-------

To use the Gandi API, you should retrieve an API key [from your account](https://account.gandi.net/),
in the security section.

You can store it into several place:

- in a file `.gandi-apikey` in the same directory of the `gandi` script
- in a file `.gandi-apikey` in your home directory
- in any file, if you set the environment variable `GANDI_APIKEY_FILE` with the
  full path to the file.

Usage
-----

Use the `gandi` script to execute command.

```
# show global help and list all commands
./gandi   

# a simple command to get the status of Gandi
./gandi status

```
