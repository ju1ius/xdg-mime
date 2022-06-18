<?php declare(strict_types=1);

use ju1ius\XdgMime\Runtime\AliasesDatabase;

return new AliasesDatabase([
    'application/x-mobi8-ebook' => 'application/vnd.amazon.mobi8-ebook',
    'application/vnd.adobe.illustrator' => 'application/illustrator',
    'application/x-mathematica' => 'application/mathematica',
    'text/mathml' => 'application/mathml+xml',
    'application/wwf' => 'application/x-wwf',
    'application/x-pdf' => 'application/pdf',
    'image/pdf' => 'application/pdf',
    'application/acrobat' => 'application/pdf',
    'application/nappdf' => 'application/pdf',
    'application/x-xspf+xml' => 'application/xspf+xml',
    'application/pgp' => 'application/pgp-encrypted',
    'application/x-rnc' => 'application/relax-ng-compact-syntax',
    'text/rtf' => 'application/rtf',
    'application/smil' => 'application/smil+xml',
    'application/x-sqlite3' => 'application/vnd.sqlite3',
    'text/gedcom' => 'application/x-gedcom',
    'application/x-flash-video' => 'video/x-flv',
    'flv-application/octet-stream' => 'video/x-flv',
    'video/flv' => 'video/x-flv',
    'application/x-xliff' => 'application/xliff+xml',
    'text/yaml' => 'application/x-yaml',
    'text/x-yaml' => 'application/x-yaml',
    'application/cdr' => 'application/vnd.corel-draw',
    'application/coreldraw' => 'application/vnd.corel-draw',
    'application/x-cdr' => 'application/vnd.corel-draw',
    'application/x-coreldraw' => 'application/vnd.corel-draw',
    'image/cdr' => 'application/vnd.corel-draw',
    'image/x-cdr' => 'application/vnd.corel-draw',
    'zz-application/zz-winassoc-cdr' => 'application/vnd.corel-draw',
    'application/x-lotus123' => 'application/vnd.lotus-1-2-3',
    'application/x-123' => 'application/vnd.lotus-1-2-3',
    'application/lotus123' => 'application/vnd.lotus-1-2-3',
    'application/wk1' => 'application/vnd.lotus-1-2-3',
    'zz-application/zz-winassoc-123' => 'application/vnd.lotus-1-2-3',
    'application/msaccess' => 'application/vnd.ms-access',
    'application/vnd.msaccess' => 'application/vnd.ms-access',
    'application/x-msaccess' => 'application/vnd.ms-access',
    'application/mdb' => 'application/vnd.ms-access',
    'application/x-mdb' => 'application/vnd.ms-access',
    'zz-application/zz-winassoc-mdb' => 'application/vnd.ms-access',
    'zz-application/zz-winassoc-cab' => 'application/vnd.ms-cab-compressed',
    'application/msexcel' => 'application/vnd.ms-excel',
    'application/x-msexcel' => 'application/vnd.ms-excel',
    'zz-application/zz-winassoc-xls' => 'application/vnd.ms-excel',
    'application/powerpoint' => 'application/vnd.ms-powerpoint',
    'application/mspowerpoint' => 'application/vnd.ms-powerpoint',
    'application/x-mspowerpoint' => 'application/vnd.ms-powerpoint',
    'application/xps' => 'application/vnd.ms-xpsdocument',
    'application/vnd.ms-word' => 'application/msword',
    'application/x-msword' => 'application/msword',
    'zz-application/zz-winassoc-doc' => 'application/msword',
    'application/ms-tnef' => 'application/vnd.ms-tnef',
    'application/vnd.stardivision.writer-global' => 'application/vnd.stardivision.writer',
    'application/vnd.sun.xml.base' => 'application/vnd.oasis.opendocument.database',
    'application/x-pcap' => 'application/vnd.tcpdump.pcap',
    'application/pcap' => 'application/vnd.tcpdump.pcap',
    'application/x-wordperfect' => 'application/vnd.wordperfect',
    'application/wordperfect' => 'application/vnd.wordperfect',
    'application/vnd.youtube.yt' => 'video/vnd.youtube.yt',
    'application/x-spss-savefile' => 'application/x-spss-sav',
    'application/x-bzip2' => 'application/x-bzip',
    'application/bzip2' => 'application/x-bzip',
    'application/x-cbr' => 'application/vnd.comicbook-rar',
    'application/x-cbz' => 'application/vnd.comicbook+zip',
    'application/x-fd-file' => 'application/x-raw-floppy-disk-image',
    'application/x-iso9660-image' => 'application/x-cd-image',
    'application/x-chess-pgn' => 'application/vnd.chess-pgn',
    'application/x-chm' => 'application/vnd.ms-htmlhelp',
    'application/x-dbase' => 'application/x-dbf',
    'application/dbf' => 'application/x-dbf',
    'application/dbase' => 'application/x-dbf',
    'text/ecmascript' => 'application/ecmascript',
    'application/x-wii-iso-image' => 'application/x-wii-rom',
    'application/x-wbfs' => 'application/x-wii-rom',
    'application/x-wia' => 'application/x-wii-rom',
    'application/x-gamecube-iso-image' => 'application/x-gamecube-rom',
    'application/x-hfe-file' => 'application/x-hfe-floppy-image',
    'application/x-sap-file' => 'application/x-thomson-sap-image',
    'application/x-deb' => 'application/vnd.debian.binary-package',
    'application/x-debian-package' => 'application/vnd.debian.binary-package',
    'application/x-gnome-app-info' => 'application/x-desktop',
    'application/x-fictionbook' => 'application/x-fictionbook+xml',
    'application/font-woff' => 'font/woff',
    'application/x-font-otf' => 'font/otf',
    'application/x-font-ttf' => 'font/ttf',
    'application/x-frame' => 'application/vnd.framemaker',
    'application/x-gzip' => 'application/gzip',
    'application/x-jar' => 'application/x-java-archive',
    'application/java-archive' => 'application/x-java-archive',
    'application/java' => 'application/x-java',
    'application/java-byte-code' => 'application/x-java',
    'application/java-vm' => 'application/x-java',
    'application/x-java-class' => 'application/x-java',
    'application/x-java-vm' => 'application/x-java',
    'application/x-javascript' => 'text/javascript',
    'application/javascript' => 'text/javascript',
    'application/x-vnd.kde.kexi' => 'application/x-kexiproject-sqlite3',
    'application/x-kexiproject-sqlite' => 'application/x-kexiproject-sqlite3',
    'application/x-lzh-compressed' => 'application/x-lha',
    'application/x-linguist' => 'text/vnd.trolltech.linguist',
    'text/vnd.qt.linguist' => 'text/vnd.trolltech.linguist',
    'text/x-lyx' => 'application/x-lyx',
    'application/x-netscape-bookmarks' => 'application/x-mozilla-bookmarks',
    'application/x-annodex' => 'application/annodex',
    'video/x-annodex' => 'video/annodex',
    'audio/x-annodex' => 'audio/annodex',
    'application/x-ogg' => 'application/ogg',
    'audio/x-ogg' => 'audio/ogg',
    'video/x-ogg' => 'video/ogg',
    'audio/vorbis' => 'audio/x-vorbis+ogg',
    'audio/x-vorbis' => 'audio/x-vorbis+ogg',
    'audio/x-oggflac' => 'audio/x-flac+ogg',
    'video/x-theora' => 'video/x-theora+ogg',
    'video/x-ogm' => 'video/x-ogm+ogg',
    'application/x-palm-database' => 'application/vnd.palm',
    'text/x-perl' => 'application/x-perl',
    'application/x-pkcs12' => 'application/pkcs12',
    'application/x-quicktimeplayer' => 'application/x-quicktime-media-link',
    'application/x-rar' => 'application/vnd.rar',
    'application/x-rar-compressed' => 'application/vnd.rar',
    'application/x-reject' => 'text/x-reject',
    'application/x-redhat-package-manager' => 'application/x-rpm',
    'text/crystal' => 'text/x-crystal',
    'text/x-sh' => 'application/x-shellscript',
    'application/x-shockwave-flash' => 'application/vnd.adobe.flash.movie',
    'application/futuresplash' => 'application/vnd.adobe.flash.movie',
    'audio/x-shorten' => 'application/x-shorten',
    'application/x-snes-rom' => 'application/vnd.nintendo.snes.rom',
    'application/stuffit' => 'application/x-stuffit',
    'application/x-sit' => 'application/x-stuffit',
    'application/x-srt' => 'application/x-subrip',
    'audio/x-iMelody' => 'text/x-iMelody',
    'audio/iMelody' => 'text/x-iMelody',
    'application/x-smaf' => 'application/vnd.smaf',
    'audio/xmf' => 'audio/x-xmf',
    'audio/vnd.nokia.mobile-xmf' => 'audio/mobile-xmf',
    'application/x-gtar' => 'application/x-tar',
    'application/x-troff' => 'text/troff',
    'text/x-troff' => 'text/troff',
    'application/x-zip-compressed' => 'application/zip',
    'application/x-zip' => 'application/zip',
    'audio/x-dts' => 'audio/vnd.dts',
    'audio/x-dtshd' => 'audio/vnd.dts.hd',
    'audio/amr-encrypted' => 'audio/AMR',
    'audio/amr-wb-encrypted' => 'audio/AMR-WB',
    'audio/x-aiffc' => 'audio/x-aifc',
    'audio/vnd.audible' => 'audio/x-pn-audibleaudio',
    'audio/dff' => 'audio/x-dff',
    'audio/dsf' => 'audio/x-dsf',
    'audio/x-dsd' => 'audio/x-dsf',
    'audio/dsd' => 'audio/x-dsf',
    'audio/x-flac' => 'audio/flac',
    'audio/x-midi' => 'audio/midi',
    'audio/x-aac' => 'audio/aac',
    'audio/x-m4a' => 'audio/mp4',
    'audio/m4a' => 'audio/mp4',
    'video/mp4v-es' => 'video/mp4',
    'video/x-m4v' => 'video/mp4',
    'video/3gp' => 'video/3gpp',
    'audio/3gpp' => 'video/3gpp',
    'video/3gpp-encrypted' => 'video/3gpp',
    'audio/3gpp-encrypted' => 'video/3gpp',
    'audio/x-rn-3gpp-amr' => 'video/3gpp',
    'audio/x-rn-3gpp-amr-encrypted' => 'video/3gpp',
    'audio/x-rn-3gpp-amr-wb' => 'video/3gpp',
    'audio/x-rn-3gpp-amr-wb-encrypted' => 'video/3gpp',
    'audio/3gpp2' => 'video/3gpp2',
    'audio/x-mp2' => 'audio/mp2',
    'audio/x-mp3' => 'audio/mpeg',
    'audio/x-mpg' => 'audio/mpeg',
    'audio/x-mpeg' => 'audio/mpeg',
    'audio/mp3' => 'audio/mpeg',
    'audio/mpegurl' => 'audio/x-mpegurl',
    'application/m3u' => 'audio/x-mpegurl',
    'audio/x-mp3-playlist' => 'audio/x-mpegurl',
    'audio/m3u' => 'audio/x-mpegurl',
    'audio/x-m3u' => 'audio/x-mpegurl',
    'video/x-ms-wvx' => 'audio/x-ms-asx',
    'video/x-ms-wax' => 'audio/x-ms-asx',
    'video/x-ms-wmx' => 'audio/x-ms-asx',
    'application/x-ms-asx' => 'audio/x-ms-asx',
    'audio/wma' => 'audio/x-ms-wma',
    'audio/x-pn-realaudio' => 'audio/vnd.rn-realaudio',
    'audio/vnd.m-realaudio' => 'audio/vnd.rn-realaudio',
    'video/x-real-video' => 'video/vnd.rn-realvideo',
    'application/vnd.rn-realmedia-vbr' => 'application/vnd.rn-realmedia',
    'application/pls' => 'audio/x-scpls',
    'audio/scpls' => 'audio/x-scpls',
    'audio/wav' => 'audio/x-wav',
    'audio/vnd.wave' => 'audio/x-wav',
    'audio/tta' => 'audio/x-tta',
    'image/x-bmp' => 'image/bmp',
    'image/x-MS-bmp' => 'image/bmp',
    'image/fax-g3' => 'image/g3fax',
    'image/heic' => 'image/heif',
    'image/heic-sequence' => 'image/heif',
    'image/heif-sequence' => 'image/heif',
    'image/pjpeg' => 'image/jpeg',
    'image/jpeg2000' => 'image/jp2',
    'image/jpeg2000-image' => 'image/jp2',
    'image/x-jpeg2000-image' => 'image/jp2',
    'image/x-panasonic-raw' => 'image/x-panasonic-rw',
    'image/x-panasonic-raw2' => 'image/x-panasonic-rw2',
    'application/docbook+xml' => 'application/x-docbook+xml',
    'application/vnd.oasis.docbook+xml' => 'application/x-docbook+xml',
    'image/x-djvu' => 'image/vnd.djvu',
    'image/x.djvu' => 'image/vnd.djvu',
    'image/x-fits' => 'application/fits',
    'image/fits' => 'application/fits',
    'application/ico' => 'image/vnd.microsoft.icon',
    'image/ico' => 'image/vnd.microsoft.icon',
    'image/icon' => 'image/vnd.microsoft.icon',
    'image/x-ico' => 'image/vnd.microsoft.icon',
    'image/x-icon' => 'image/vnd.microsoft.icon',
    'text/ico' => 'image/vnd.microsoft.icon',
    'image/x-iff' => 'image/x-ilbm',
    'image/x-pcx' => 'image/vnd.zbrush.pcx',
    'image/psd' => 'image/vnd.adobe.photoshop',
    'image/x-psd' => 'image/vnd.adobe.photoshop',
    'image/photoshop' => 'image/vnd.adobe.photoshop',
    'image/x-photoshop' => 'image/vnd.adobe.photoshop',
    'application/photoshop' => 'image/vnd.adobe.photoshop',
    'application/x-photoshop' => 'image/vnd.adobe.photoshop',
    'application/tga' => 'image/x-tga',
    'application/x-targa' => 'image/x-tga',
    'application/x-tga' => 'image/x-tga',
    'image/targa' => 'image/x-tga',
    'image/tga' => 'image/x-tga',
    'image/x-icb' => 'image/x-tga',
    'image/x-targa' => 'image/x-tga',
    'image/x-emf' => 'image/emf',
    'application/x-emf' => 'image/emf',
    'application/emf' => 'image/emf',
    'image/x-wmf' => 'image/wmf',
    'image/x-win-metafile' => 'image/wmf',
    'application/x-wmf' => 'image/wmf',
    'application/wmf' => 'image/wmf',
    'application/x-msmetafile' => 'image/wmf',
    'image/x-xpm' => 'image/x-xpixmap',
    'x-directory/normal' => 'inode/directory',
    'text/x-vcalendar' => 'text/calendar',
    'application/ics' => 'text/calendar',
    'text/directory' => 'text/vcard',
    'text/x-vcard' => 'text/vcard',
    'text/rdf' => 'application/rdf+xml',
    'text/rss' => 'application/rss+xml',
    'text/x-opml' => 'text/x-opml+xml',
    'text/x-comma-separated-values' => 'text/csv',
    'text/x-csv' => 'text/csv',
    'text/x-c' => 'text/x-csrc',
    'text/x-dtd' => 'application/xml-dtd',
    'text/x-po' => 'text/x-gettext-translation',
    'application/x-gettext' => 'text/x-gettext-translation',
    'text/x-pot' => 'text/x-gettext-translation-template',
    'text/google-video-pointer' => 'text/x-google-video-pointer',
    'text/x-markdown' => 'text/markdown',
    'text/x-octave' => 'text/x-matlab',
    'text/x-diff' => 'text/x-patch',
    'text/x-sql' => 'application/sql',
    'text/x-tcl' => 'text/tcl',
    'application/x-tex' => 'text/x-tex',
    'zz-application/zz-winassoc-uu' => 'text/x-uuencode',
    'text/vbs' => 'text/vbscript',
    'text/xml' => 'application/xml',
    'text/xml-external-parsed-entity' => 'application/xml-external-parsed-entity',
    'video/x-mpeg' => 'video/mpeg',
    'video/mpeg-system' => 'video/mpeg',
    'video/x-mpeg-system' => 'video/mpeg',
    'video/x-mpeg2' => 'video/mpeg',
    'video/x-mpegurl' => 'video/vnd.mpegurl',
    'video/vivo' => 'video/vnd.vivo',
    'video/fli' => 'video/x-flic',
    'video/x-fli' => 'video/x-flic',
    'application/vnd.haansoft-hwp' => 'application/x-hwp',
    'application/vnd.haansoft-hwt' => 'application/x-hwt',
    'video/x-ms-wm' => 'application/vnd.ms-asf',
    'video/x-ms-asf' => 'application/vnd.ms-asf',
    'video/x-ms-asf-plugin' => 'application/vnd.ms-asf',
    'video/x-avi' => 'video/x-msvideo',
    'video/avi' => 'video/x-msvideo',
    'video/divx' => 'video/x-msvideo',
    'video/msvideo' => 'video/x-msvideo',
    'video/vnd.divx' => 'video/x-msvideo',
    'application/x-sdp' => 'application/sdp',
    'application/vnd.sdp' => 'application/sdp',
    'application/vnd.geo+json' => 'application/geo+json',
    'application/gpx' => 'application/gpx+xml',
    'application/x-gpx+xml' => 'application/gpx+xml',
    'application/x-gpx' => 'application/gpx+xml',
    'zz-application/zz-winassoc-hlp' => 'application/winhlp',
    'application/x-trig' => 'application/trig',
    'application/x-iwork-keynote-sffkey' => 'application/vnd.apple.keynote',
    'application/x-iwork-numbers-sffnumbers' => 'application/vnd.apple.numbers',
    'application/x-iwork-pages-sffpages' => 'application/vnd.apple.pages',
    'application/vnd.xdgapp' => 'application/vnd.flatpak',
    'application/vnd.ms-3mfdocument' => 'model/3mf',
    'model/x.stl-ascii' => 'model/stl',
    'model/x.stl-binary' => 'model/stl',
    'application/x-virtualbox-ova' => 'application/ovf',
    'application/x-virtualbox-vhd' => 'application/x-vhd-disk',
    'application/x-virtualbox-vhdx' => 'application/x-vhdx-disk',
    'application/x-virtualbox-vmdk' => 'application/x-vmdk-disk',
    'application/x-virtualbox-vdi' => 'application/x-vdi-disk',
    'image/avif-sequence' => 'image/avif',
]);
