<p align="center"><a href="https://dev.piedweb.com">
<img src="https://raw.githubusercontent.com/PiedWeb/piedweb-devoluix-theme/master/src/img/logo_title.png" width="200" height="200" alt="Open Source Package" />
</a></p>

# Logs Analyzer

[![Latest Version](https://img.shields.io/github/tag/PiedWeb/LogsAnalyzer.svg?style=flat&label=release)](https://github.com/PiedWeb/LogsAnalyzer/tags)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](https://github.com/PiedWeb/LogsAnalyzer/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/PiedWeb/LogsAnalyzer/master.svg?style=flat)](https://travis-ci.org/PiedWeb/LogsAnalyzer)
[![Quality Score](https://img.shields.io/scrutinizer/g/PiedWeb/LogsAnalyzer.svg?style=flat)](https://scrutinizer-ci.com/g/PiedWeb/LogsAnalyzer)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/PiedWeb/LogsAnalyzer.svg?style=flat)](https://scrutinizer-ci.com/g/PiedWeb/LogsAnalyzer/code-structure)
[![Total Downloads](https://img.shields.io/packagist/dt/piedweb/logs-analyzer.svg?style=flat)](https://packagist.org/packages/piedweb/logs-analyzer)

This package can parse, filter and export to CSV via PHP or CLI your APACHE/Nginx/Microsoft/WhatYouWant logs.

## Install

Via [Packagist](https://packagist.org/packages/piedweb/logs-analyzer)

``` bash
$ composer require piedweb/logs-analyzer
```

## Usage

Tu use it directly in php, see [bin/analyzer](https://github.com/PiedWeb/LogsAnalyzer/blob/master/bin/analyzer) example.

Else, you can use the command tools to filter and export to CSV your log files. Get the last args list via `--help` :
``` bash
bin/analyzer --help
```

### About `--format`

Default parser work with Apache Access Logs :
```
^(?P<host>[a-zA-Z0-9\-\._:]+) (?P<logname>(?:-|[\w-]+)) (?P<user>(?:-|[\w\-\.]+)) \[(?P<time>\d{2}/(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)/\d{4}:\d{2}:\d{2}:\d{2} (?:-|\+)\d{4})\] "(?P<request>(?:(?:[A-Z]+) .+? HTTP/(1\.0|1\.1|2\.0))|-|)" (?P<status>\d{3}|-) (?P<responseBytes>(\d+|-)) "(?P<HeaderReferer>.*?)" "(?P<HeaderUserAgent>.*?)"$
```

You can change the regex directly via the CLI or by creating a new Class managing your special format. Your new class must extends `\PiedWeb\LogsAnalyzer\LogLine`.

### About `--resume`

This arg permits to have only unique request (`requestMethod` + `url` + `status`) keeping only the first `date` and `time` and counting the number of `hit`

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing](https://dev.piedweb.com/contributing)

## Credits

- [PiedWeb](https://piedweb.com)
- [All Contributors](https://github.com/PiedWeb/:package_skake/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[![Latest Version](https://img.shields.io/github/tag/PiedWeb/LogsAnalyzer.svg?style=flat&label=release)](https://github.com/PiedWeb/LogsAnalyzer/tags)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](https://github.com/PiedWeb/LogsAnalyzer/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/PiedWeb/LogsAnalyzer/master.svg?style=flat)](https://travis-ci.org/PiedWeb/LogsAnalyzer)
[![Quality Score](https://img.shields.io/scrutinizer/g/PiedWeb/LogsAnalyzer.svg?style=flat)](https://scrutinizer-ci.com/g/PiedWeb/LogsAnalyzer)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/PiedWeb/LogsAnalyzer.svg?style=flat)](https://scrutinizer-ci.com/g/PiedWeb/LogsAnalyzer/code-structure)
[![Total Downloads](https://img.shields.io/packagist/dt/piedweb/logs-analyzer.svg?style=flat)](https://packagist.org/packages/piedweb/logs-analyzer)
