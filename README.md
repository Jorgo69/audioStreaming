Token Git = https://github.com/settings/tokens?page=1


 
 Pour installer SoX (Sound eXchange) sous Ubuntu, vous pouvez suivre les étapes suivantes. Voici un guide étape par étape :

Étapes d'installation de SoX
Ouvrir le terminal :

Vous pouvez ouvrir le terminal en cherchant "Terminal" dans le menu ou en utilisant le raccourci Ctrl + Alt + T.
Mettre à jour les dépôts :

Avant d'installer un nouveau logiciel, il est recommandé de mettre à jour la liste des paquets disponibles :
sudo apt update
Installer SoX :

Pour installer SoX, utilisez la commande suivante :
sudo apt install sox
Installer des codecs supplémentaires (facultatif) :

Si vous avez besoin de support pour des formats audio supplémentaires (comme MP3), vous pouvez également installer le paquet libsox-fmt-mp3 :
sudo apt install sox libsox-fmt-mp3
Vérification de l'installation
Pour vérifier que SoX est correctement installé, vous pouvez exécuter la commande suivante :

sox --version
Résumé
Commande pour mettre à jour :

sudo apt update
Commande pour installer SoX :

sudo apt install sox
Commande pour installer le support MP3 (facultatif) :

sudo apt install libsox-fmt-mp3
Après avoir suivi ces étapes, SoX devrait être installé et prêt à l'emploi sur votre système Ubuntu. Si vous avez d'autres questions ou besoin d'aide, n'hésitez pas à demander !


MAIL_DRIVER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=ibralejorgo@gmail.com
MAIL_PASSWORD=*******************
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=ibralejorgo@gmail.com
MAIL_FROM_NAME="${APP_NAME}"



SoX (Sound eXchange) est un outil très puissant pour manipuler des fichiers audio, mais il est important de noter que l'installation de base ne comprend pas tous les codecs et formats audio. Voici quelques points à considérer :

Ce qui est inclus avec l'installation de SoX
Fonctionnalités de base : L'installation par défaut de SoX vous permet de faire des opérations de base telles que :
Lire des fichiers audio.
Convertir des fichiers audio d'un format à un autre.
Éditer des fichiers audio (couper, coller, etc.).
Appliquer des effets audio.
Ce qui peut manquer
Formats audio spécifiques : Par défaut, SoX peut ne pas inclure le support pour certains formats audio populaires, notamment :
MP3
WAV
OGG
FLAC
Installation de formats supplémentaires
Pour garantir que vous avez le support pour de nombreux formats audio, il est recommandé d'installer des paquets supplémentaires :

Support MP3 :

Utilisez la commande suivante :
sudo apt install libsox-fmt-mp3
Autres formats :

Selon vos besoins, vous pourriez vouloir installer d'autres bibliothèques de format, comme :
sudo apt install libsox-fmt-ogg
sudo apt install libsox-fmt-flac
Résumé
Installation de base : SoX est installé avec des fonctionnalités de base.
Formats supplémentaires : Vous devrez installer des paquets supplémentaires pour obtenir le support de formats spécifiques comme MP3, OGG, et FLAC.
Si vous avez besoin d'une fonctionnalité ou d'un format spécifique, n'hésitez pas à le mentionner, et je vous aiderai à trouver les bonnes commandes pour l'installer !


La doc dispo sur google docs: [Documentation](https://docs.google.com/document/d/1nXNT0F8BGohvdsJ0GRR0FGu1j87lH_HOMMaVyjkgZsM/edit?usp=sharing)

## Installer de Sox sur la machine [Obligatoire]

