# Установка

## Linux и Windows на одном диске
Устанавливаем Windows без подключенного интернета
При установке Linux подключаем интернет с Live-USB
Порядок boot: 1) Linux USB 2) HDD, с установленной Windows 3) Windows boot loader
Обязательно ставьте пароли на учетные записи

## Google Chrome
- [Устанавливаем Google Chrome](https://www.google.ru/chrome/)

## GitHub
- [Регистрируемся в GitHub](https://github.com/)

## SSH ключ

1. [Github.com](https://github.com/)
2. [Настройки профиля](https://github.com/settings/profile)
3. [SSH and GPG keys](https://github.com/settings/keys)
4. [New SSH Key](https://github.com/settings/ssh/new)
5. Добавьте свой ключ. [Как создать ключ?](https://docs.github.com/ru/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent?platform=linux)

## Git
Установка git, в консоле пишем:

Mac OS:

```shell
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)"
```

```shell
brew install git
```

Linux:

```shell
sudo apt install git
```

Настройка git:

Глобальные настройки Git для Linux и Mac OS,
где имена меняем на свои и почту меняем на ту, на которую регали gitlab:

`git config --global user.name "Петр Иванов"`

`git config --global user.email "petr@CloudCrmWeb.cam"`

## Toolbox App
- [Устанавливаем Toolbox App](https://www.jetbrains.com/toolbox-app/)

## PhpStorm

Устанавливаем PhpStorm через Toolbox App. Если не устанавливается:

```shell
sudo apt install fuse
```

## PhpStorm Plugins

- .env files support
- .ignore
- Atom Material Icons
- Ideolog
- Material Theme UI
- PHP Annotations
- Php Inspections (EA Extended)
- Yii2 Inspections
- Yii2 Support
- Недостающие плагины находятся в "Phpstorm" по File/settings/plugins

## Docker and Docker Compose

По этой статье ставим докер:

Mac:
- https://docs.docker.com/docker-for-mac/install/

Linux:

- https://docs.docker.com/engine/install/ubuntu/
- После установки в терминале прописываем команду: `sudo usermod -aG docker $USER` -
  после этого перезагружаете свой компьютер.

## Установка проекта

1. Создаем общую папку:

Mac:

```shell
cd /Users/<user>/PhpstormProjects/
```

Linux:

```shell
cd /home/<user>/PhpstormProjects/
```

2. Клонируем проект:

```shell
git clone git@github.com:CloudCrmWeb/Training.git
```

3. Устанавливаем Selenoid:

```shell
docker pull selenoid/vnc:chrome_119.0
```

4. Поднимаем проект:

```shell
docker compose up -d --build
```

5. Устанавливаем пакеты:

```shell
docker compose exec -u yii2 backend bash -c "composer install"
```

6. Запускам миграции:

```shell
docker compose exec -u yii2 backend bash -c "php /var/www/html/yii migrate/up"
```

## Возможные ошибки

1. Ошибка занятости порта

```
ERROR: for training_nginx_1 Cannot start service nginx: driver failed programming external connectivity on endpoint training_nginx_1 (82f8aeeb230d9b4d670a224936519391748e3dcca354590f4950a5ae28c77a04): Error starting userland proxy: listen tcp4 0.0.0.0:80: bind: address already in use
```

Ошибка указывает на то что порт 80, который хочет слушать nginx, занят. Скорее всего его будет слушать apache.

Для начала проверь кто слушает порт:

### NetStat синтаксис Linux

```shell
netstat -tulpn | grep НОМЕР_ПОРТА
```

Если его слушает apache сноси его :)

### Удалить apache для Ubuntu

```shell
sudo apt remove apache2
```

Если указывает что порт пустой нужно переустановить docker engine и docker compose.