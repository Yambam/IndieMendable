#!/bin/bash
cd /media/seagate/htdocs/gamemaker/locale/nl_NL.utf8/LC_MESSAGES
echo ""
for dir in /media/seagate/htdocs/gamemaker/locale/*.utf8/; do
    dir=${dir%*/};
    cd "../../${dir##*/}/LC_MESSAGES";
    echo "<i>${dir##*/}:</i>";
    msgfmt -v messages.po;
    msgcat --output-file=messages_new.po --use-first ./messages.po ../../en_US.utf8/LC_MESSAGES/messages.po
    msgfmt --output-file=messages.mo messages_new.po;
    echo "";
done
cd "../.."
