<img align="right" src="/README-Assets/qubino_control.jpg" width="150">

# php-devoloDHC-quibino-2flush

### What is it?

This is a CLI php script to control the *Qubino Flush 2 Relay ZMNHBDx* using the php API [php-devoloDHC](https://github.com/KiboOst/php-devoloDHC) for *Devolo* Home Control (DHC) from [KiboOst](https://github.com/KiboOst).

### What it no can do ...
is to update the state of the relay within DHC when the *Qubino Flush 2 Relay* is triggered with a connected switch on I1/I2. This requires still an update of *Devolo* Home Control itself - Let's hope *Devolo* is making their software smarter

### Introduction

*Devolo* is not yet supporting all functions of the *Quibino Flush 2 relay*. Out of the reduced functionality you cannot directly switch the individual contacts from outside *Devolo* Home Control. To overcome this pitfall this script uses DHC scenes to switch on and off the relays. But in case we have two relays this would mean we end up with 6 different scenes (combinations) which is quite uncomfortable to use in other applications like [ha-bridge](https://github.com/bwssytems/ha-bridge) (For example to individual switch on/off per relay with a Harmony Hub).

This script makes it easy giving you a single command to switch individual relay state. The script calls the right DHC scene based on the given device name. Feel free to submit an issue or pull request to add more.

*This isn't an official Qubino or Devolo script* | **USE AT YOUR OWN RISK!<br />**

### Table of content
1. [Requirements](#requirements)<br />
1. [How-to](#how-to)<br />
  1. [Change the script to your environment](#change-the-script-to-your-environment)<br />
  1. [Prepare Devolo Home Control Scenes](#prepare-devolo-home-control-scenes)<br />
1. [Usage examples](#usage-example)<br />
1. [Version history](#version-history)<br />

<img align="right" src="/README-Assets/questionmark.png" width="48">

### Requirements  [&#8657;](#php-devolodhc-quibino-2flush)

- PHP v5+
- [php-devoloDHC](https://github.com/KiboOst/php-devoloDHC) API
- Devolo Home Control (Hardware and Registration)
- The script require internet access (it will authenticate against Devolo servers) via the php-devoloDHC API.

<img align="right" src="/README-Assets/read.png" width="48">

### How-to [&#8657;](#php-devolodhc-quibino-2flush)

- Check if PHP is installed on your system (by using ```$ php -v``` on your command line)
- Download class[php-devoloDHC](https://github.com/KiboOst/php-devoloDHC) and put it on your server/computer at a location of your choice.<br><br>If you can, allow write permission on php-devoloDHC API folder. It will support keeping DHC user session between consecutive executions of your script (also lot faster).<br><br>
- Download the script and store it at your desired location (e.g ```/home/your user name/php-devoloDHC-quibino-2flush```)
- Assure the script is executable by using the command ```chmod +x  php-devoloDHC-quibino-flush2relays.php```
- [Change](#change-the-script-to-your-environment) the script and fill it with the needed credentials
- Prepare *Devolo* Home Control and [create](#prepare-devolo-home-control-scenes) the required scenes

<img align="right" src="/README-Assets/requirements.png" width="48">

### Change the script to your environment [&#8657;](#php-devolodhc-quibino-2flush)

The script needs to be checked and updated with your credentials at two places

 1. **Check/correct the path to the php-devoloDHC API**<br>
 Replace the paths with yours, where you have stored the API.
 ```bash
 require($_SERVER['DOCUMENT_ROOT']."/dhc-php-api/phpDevoloAPI.php");
 require($_SERVER['DOCUMENT_ROOT']."/dhc-php-api/localphpdevoloAPI.php");
 ```
 2. **Insert your *Devolo* Login and device credentials**<br>
 For details how to get uuid, passkey, ... follow the perfect guide from [KiboOst](https://github.com/KiboOst) mentioned in the [php-devoloDHC API](https://github.com/KiboOst/php-devoloDHC).

  ```bash
 $login    = "<ENTER YOUR YOUR LOGIN E-MAIL ADDRESS>";
 $password = "<ENTER YOUR YOUR LOGIN PASSWORD>";
 $localIP  = "<ENTER YOUR YOUR DHC LOCAL IP ADDRESS>";
 $uuid     = "<ENTER YOUR DHC UUID STRING>";
 $gateway  = "<ENTER YOUR DHC GATEWAY ID>";
 $passkey  = "<ENTER YOUR DHC PASSKEY>";
 ```

<img align="right" src="/README-Assets/requirements.png" width="48">
### Prepare Devolo Home Control Scenes [&#8657;](#php-devolodhc-quibino-2flush)

In order order to let the CLI script work you need to provide 6 DHC scenes. The scene name must defined as followins within DHC:

> {device name} {white space} {relay contact number [all, 1, 2]} {white space} {[on, off]}

For a better understanding see example below in table format which demonstrate the required settings. In this example the *Quibino Flush 2 relay* is named *Wohnzimmer* within DHC. All shown states are applied on this device.
  <br>

Set | Scene Name | state relay #1 | state relay #2
--:-|---|:---:|:---:
01 | Wohnzimmer #1 on | on | off
02 | Wohnzimmer #1 off | off | on
03 | Wohnzimmer #2 on | on | off
04 | Wohnzimmer #2 off | off | on
05 | Wohnzimmer all on | on | on
06 | Wohnzimmer all off | off | off
  <br>

<img align="right" src="/README-Assets/set.png" width="48">

### Usage examples [&#8657;](#php-devolodhc-quibino-2flush)

Now let's have fun. After the Scenes are created and the script credentials are set correct we can play with it. See the following example calls. *Change devices names and paths by yours!*<br>
  <br>
**How to start the script?** [&#8657;](#php-devolodhc-quibino-2flush)

```bash
# change to the directory location where the script is stored
$ cd /home/user-namer/php-devoloDHC-quibino-flush2relays

# execute script
$ ./php-devoloDHC-quibino-flush2relays.php

# or Execute the script with full qualified path
$ /home/user-namer/php-devoloDHC-quibino-flush2relays/php-devoloDHC-quibino-flush2relays.php
```

Calling the script without any arguments will prompt you with the Help Dialog

```bash
Starting CLI better control Qubino 2 Flush relays with the DHC php API ...

ERROR: Unkown arguments received!

Usage:   ./php-devoloDHC-quibino-flush2relays.php [device name] [contact number] [action]

  [device name]
    DHC Name of the Qubino 2Flush Relay.
    The related DHC scenes must begin with the devicename.

  [contact number]
    The Contact number to be controlled:
      0: Relay contact 1 & 2
      1: Relay contact 1
	    2: Relay Contact 2

    The related DHC scenesmust containt the number beginning with a '#'.

  [action]
    on:  Set the given relay contact to on
    off: Set the given relay contact to off

    The related DHC scenes must end with on, off depending on the DHC rule function


Example: ./php-devoloDHC-quibino-flush2relays.php "living room" 1 on

    This will switch on the relay contact number 1 of the DHC Living Room device.
    The CLI will call the DHC scene "living room #1 on"

Version:
    v0.1 (2017-09-22)
```

**Some examples** [&#8657;](#php-devolodhc-quibino-2flush)

```bash
# switch relay contact 1 of device "Wohnzimmer" on
$ ./php-devoloDHC-quibino-flush2relays.php Wohnzimmer 1 on

# switch relay contact 2 of device "Wohnzimmer" on
# and do not change the sate of contact relay 1 as previously set
$ ./php-devoloDHC-quibino-flush2relays.php Wohnzimmer 2 on

# switch relay contact 1 of device "Wohnzimmer" off
# and do not change state of relay contact 2
$ ./php-devoloDHC-quibino-flush2relays.php Wohnzimmer 2 off

# switch all relay contacts of device "Wohnzimmer" off
# which will in this test case only switch off relay contact 2 because
# relay contact 1 already switched off with previous command
$ ./php-devoloDHC-quibino-flush2relays.php Wohnzimmer 0 off
```

<img align="right" src="/README-Assets/changes.png" width="48">

### Version history [&#8657;](#php-devolodhc-quibino-2flush)

###### v 0.1 (2017-09-22)

 - Created: Initial version.

<img align="right" src="/README-Assets/mit.png" width="48">

### License [&#8657;](#php-devolodhc-quibino-2flush)

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
FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.


## Thanks [&#8657;](#php-devolodhc-quibino-2flush)

Last but not least thanks to [KiboOst](https://github.com/KiboOst) who as inspired me with his [php-devoloDHC](https://github.com/KiboOst/php-devoloDHC) work. Some parts of his readme structure has been reused to design this page.

I am new in the home automation world but it's fun especially with this great community!
