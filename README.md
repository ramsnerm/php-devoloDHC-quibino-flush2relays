<img align="right" src="/readmeAssets/qubino_control.jpg" width="150">

# php-devoloDHC-quibino-2flush

This is a php script to control the Qubino Flush 2 Relay ZMNHBDx using the php API [php-devoloDHC](https://github.com/KiboOst/php-devoloDHC) for Devolo Home Control from [KiboOst](https://github.com/KiboOst).

## What is it about?

Devolo is not yet supporting all functions of the Quibino Flush 2 relay. Out of the reduced functionality you cannot directly switch the individual contacts from outside Devolo Home Control. To overcome this pitfall this script uses DHC scenes to switch on and off the relays. 

But in case we have two relays this would mean we end up with 6 different scenes (combinations) which is quite uncomfortable to use in other applications like [ha-bridge](https://github.com/bwssytems/ha-bridge) (I just wanted to have individual on/off commands per relay to add them for example to my Harmony Hub). 

This script makes it easy giving you a single command to switch individual relay state. The script calls the right DHC scene based on the given device name. 

Feel free to submit an issue or pull request to add more.

*This isn't an official Qubino or Devolo script | USE AT YOUR OWN RISK!<br />*

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
- The script require internet access (it will authenticate against Devolo servers) via the php-devoloDHC API.

[&#8657;](#php-devolodhc-quibino-2flush)
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

[&#8657;](#php-devolodhc-quibino-2flush)
<img align="right" src="/readmeAssets/read.png" width="48">

#### Prepare Devolo Home Control Scenes<br />
*Change devices names by yours!*

```
The CLI will call the DHC scene \"living room #1 on\"\n"
```

[&#8657;](#php-devolodhc-quibino-2flush)
<img align="right" src="/readmeAssets/set.png" width="48">

#### Usage examples<br />


[&#8657;](#php-devolodhc-quibino-2flush)
<img align="right" src="/readmeAssets/changes.png" width="48">

## Version history

#### v 0.1 (2017-09-22)
- Created: Initial version.

[&#8657;](#php-devolodhc-quibino-2flush)
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


Thanks

Thanks to @tattn (https://github.com/tattn/homebridge-rm-mini3), @PJCzx (https://github.com/PJCzx/homebridge-thermostat) @momodalo (https://github.com/momodalo/broadlinkjs) whose time and effort got me started.
