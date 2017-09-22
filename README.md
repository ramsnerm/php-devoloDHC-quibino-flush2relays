<img align="right" src="/readmeAssets/qubino_control.jpg" width="150">

# php-devoloDHC-quibino-2flush

A php script to control the Qubino Flush 2 Relay using the php API for Devolo Home Control from @KiboOst

## What is it about?

This ,,,,

Feel free to submit an issue or pull request to add more.

*This isn't an official Qubino script | USE AT YOUR OWN RISK!<br />
Anyway this API use the php API php-devoloDHC for Devolo devloped by KiboOst.*

[Requirements](#requirements)<br />
[How-to](#how-to)<br />
[Add Devolo Credentials](#add-Devolo-credentials)<br />
[Prepare Devolo Home Control](#prepare-devolo-home-control-scenes)<br />
[Usage examples](#usage-example)<br />
[Version history](#version-history)<br />

<img align="right" src="/readmeAssets/requirements.png" width="48">

## Requirements
- PHP v5+
- php-devoloDHC from KiboOst
- The script require internet access (it will authenticate against Devolo servers) via teh API.

[&#8657;](#php-devoloDHC-quibino-2flush)
<img align="right" src="/readmeAssets/howto.png" width="48">

## How-to
- Download class/phpDevoloAPI.php and put it on your server (if not already done).
- If you can, allow write permission for the API folder. It will support keeping DHC user session between consecutive executions of your script (also lot faster).
- 
- 

#### Add Devolo Credentials
*Change credentials by yours!*
xxxx

```$login 		= "<ENTER YOUR YOUR LOGIN E-MAIL ADDRESS>";
$password 	= "<ENTER YOUR YOUR LOGIN PASSWORD>";
$localIP 	= "<ENTER YOUR YOUR DHC LOCAL IP ADDRESS>";
$uuid 		= "<ENTER YOUR DHC UUID STRING>";
$gateway 	= "<ENTER YOUR DHC GATEWAY ID>";
$passkey 	= "<ENTER YOUR DHC PASSKEY>";
```

[&#8657;](#php-devoloDHC-quibino-2flush)
<img align="right" src="/readmeAssets/read.png" width="48">

#### Prepare Devolo Home Control Scenes<br />
*Change devices names by yours!*

```
The CLI will call the DHC scene \"living room #1 on\"\n"
```

[&#8657;](#php-devoloDHC-quibino-2flush)
<img align="right" src="/readmeAssets/set.png" width="48">

#### Usage examples<br />


[&#8657;](#php-devoloDHC-quibino-2flush)
<img align="right" src="/readmeAssets/changes.png" width="48">

## Version history

#### v 0.1 (2017-09-22)
- Created: Initial version.

[&#8657;](#php-devoloDHC-quibino-2flush)
<img align="right" src="/readmeAssets/mit.png" width="48">

## License

The MIT License (MIT)

Copyright (c) 2017 ramsnerm

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
