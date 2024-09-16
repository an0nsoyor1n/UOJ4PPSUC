# Front End of PPSUCOJ

In the folder ``web`` is the source code of the front end of PPSUCOJ.

- Developed with ``PHP`` , ``css`` and ``JavaScript``
- Organized with [Docker](https://www.docker.com/)

## Structure of the source code

The web folder contains the source code for the front end of the PPSUCOJ system. 
- Root Directory: Contains a few configuration files, including Dockerfile, index.php, install.sh, and readme.md.
- css: A directory for CSS files such as blog-editor.css, bootstrap-dialog.min.css, and uoj-theme.css.
- js: A directory for JavaScript files, including LAB.min.js, base64.min.js, and uoj.js.
- app: Contains the core application files such as cli.php, route.php, and directories like controllers, models, and views.

## modify of the language

1. add a button in file ``web/app/models/UOJLocale.php``(fill the LANGUAGE_FILE_NAME and LANGUAGE_NAME with your language file name and language name)

```PHP
<div class="dropdown-menu">
	<a class="dropdown-item" href="<?= HTML::url(UOJContext::requestURI(), array('params' => array('locale' => 'LANGUAGE_FILE_NAME'))) ?>">LANGUAGE_NAME</a>
</div>
```

2. add your language translation file in ``web/app/locale/basic``, ``web/app/locale/contests`` and ``web/app/locale/problems``, the file name should be ``LANGUAGE_FILE_NAME.php``
3. modify configure in ``web/app/models/UOJLocale.php``, add ``LANGUAGE_NAME`` in the array of ``$supported_locales``

## Location of the source code

- Main page(including announcements and rated): web/app/controllers/index.php
- Main navigation bar: web/app/views/main-nav.php
- Hack list: web/app/controllers/hack_list.php
- Submission list: web/app/controllers/submissions_list.php
- Blog page and blog list: web/app/controllers/blogs.php
- faq: web/app/controllers/faq.php
- localize (language configure) file: web/app/models/UOJLocale.php