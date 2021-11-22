# Stage Lms 2021

#### Для запуска проекта, требуется выполнить следующие шаги:
- git clone https://git.devspark.ru/m_kultyshev/stage-lms-2021.git
- composer install
- переименовать файл .env.example в .env и произвести необходимые настройки

#### Создание новой миграции
php artisan make:migration create_flights_table
#### Запуск миграций
php artisan migrate
#### Откат произвольного числа миграций
php artisan migrate:rollback --step=5
#### Создание сидера
php artisan make:seeder UserSeeder
#### Запуск сидера
php artisan db:seed --class=UserSeeder
### Создание Wysiwyg 
У всех элементов textarea, где его необходимо реализовать, в качестве id указать basic-wysiwyg
### Документация Wysiwyg
В данном проекте используетя wysiwyg типа TinyMCE DOCS.
Это введение в TinyMCE подробно описывает параметры, используемые в традиционных макетах на основе форм, полезную информацию для создания оптимизированного взаимодействия с пользователем и примеры использования TinyMCE в качестве встроенного редактора.
Фрагменты включают selector вариант, описанный ниже. Измените значение рабочего блока кода в соответствии с HTML.
Вставьте фрагмент в HTML-документ между <script> теги и обновите селектор, как описано ниже.  
Для интеграции TinyMCE требуется конфигурация селектора. Конфигурация селектора использует CSS selectorсинтаксис, чтобы определить, какие элементы на странице доступны для редактирования через TinyMCE.
TinyMCE визуально заменяет выбранный элемент на iframe(редактируемая область содержимого) и элементы пользовательского интерфейса (такие как панель инструментов, строка меню и строка состояния).
В следующем примере заменяются все textareaэлементы на странице с экземплярами TinyMCE:

```
tinymce.init({
  selector: 'textarea'
});
```


TinyMCE также может соответствовать idатрибут.
В следующем примере заменяется textareaэлемент с id "default"на странице:

```
tinymce.init({
  selector: 'textarea#default'
});
```

Селектор может нацеливаться на большинство блочных элементов, когда редактор используется в режиме встроенного редактирования . Встроенный режим редактирует содержимое на месте, вместо того, чтобы заменять элемент на iframe.
В следующем примере используется selectorв режиме встроенного редактирования на divэлемент с id 'editable':

```
tinymce.init({
  selector: 'div#editable',
  inline: true
});
```

Функциональность TinyMCE расширена за счет использования плагинов, которые включаются с помощью pluginsвариант.
В следующем примере включаются списки ( lists), Расширенные списки ( advlist), Ссылка ( link) и Изображение ( image) плагины.

```
tinymce.init({
  selector: 'textarea', 
  plugins: 'advlist link image lists'
});
```


Более подробный список плагинов представлен на официальной сайте TinyMCE https://www.tiny.cloud/docs/plugins/opensource/

TinyMCE предоставляет набор элементов управления панели инструментов по умолчанию, которые можно переопределить с помощью toolbarвариант.
Элементы управления панели инструментов по умолчанию
Панель инструментов TinyMCE по умолчанию содержит следующие кнопки:

```
tinymce.init({
  selector: 'textarea',
  toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent'
});
```


В toolbar опция определяет наличие, порядок и группировку кнопок панели инструментов.

Используйте список, разделенный пробелами, чтобы указать кнопки панели инструментов для TinyMCE. Создавайте группы панелей инструментов с помощью кнопки "|" символ вертикальной черты между названиями кнопок. 

Есть два варианта меню: menubarа также menu. menubar используется для определения наличия и порядка меню , таких как «Файл» , 
«Правка» и «Просмотр», menu используется для определения наличия и порядка пунктов меню , таких как «Новый документ» , «Выбрать все» и «Исходный код» .
Примеры конфигурации меню и строки меню
Чтобы отобразить меню «Файл» , «Правка» и «Просмотр» :

```
tinymce.init({
  selector: 'textarea', 
  menubar: 'file edit view'
});
```


Чтобы создать Editменю, которое содержит только пункты «Отменить» , «Вернуть» и «Выбрать все».

```
tinymce.init({
  selector: 'textarea',
  menu: {
    edit: {title: 'Edit', items: 'undo, redo, selectall'}
  }
});
```


Чтобы создать меню с названием «Happy», укажите идентификатор для меню и объект с titleа также itemsдля меню.
Например:

```
tinymce.init({
  selector: 'textarea',
  menu: {
    happy: {title: 'Happy', items: 'code'}
  },
  plugins: 'code',
  menubar: 'happy'
});
```


Элементы управления меню по умолчанию
Меню по умолчанию следующие:

```
tinymce.init({
  selector: 'textarea',
  menu: {
    file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
    edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
    view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
    insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
    format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },
    tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
    table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
    help: { title: 'Help', items: 'help' }
  }
});
```


В следующем примере представлена ​​базовая конфигурация TinyMCE.

```
  tinymce.init({
    selector: '#myTextarea',
    width: 600,
    height: 300,
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'table emoticons template paste help'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
      'forecolor backcolor emoticons | help',
    menu: {
      favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'css/content.css'
  });
```

Разбор базового примера конфигурации
В следующем разделе представлены параметры, использованные в примере базовой конфигурации.
Выбирает textareaс идентификатором myTextareaбыть замененным редактором.

`selector: '#myTextarea',`

Устанавливает ширину и высоту редактируемой области в пикселях как числовые значения.

```
width: 600,
height: 300,
```

Выбирает плагины для включения при загрузке.

```
plugins: [
  'advlist autolink link image lists charmap print preview hr anchor pagebreak',
  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
  'table emoticons template paste help'
],
```

Выбирает кнопки панели инструментов, отображаемые пользователю. В качестве разделителя используйте запятую или пробел.

`toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons',`

Добавляет дополнительное меню «Мое избранное» с menu, затем добавляет его в строку меню с помощью menubar.

```
menu: {
  favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
},
menubar: 'favs file edit view insert format tools table help',
```

Устанавливает стиль редактируемой области с помощью content_css.

`content_css: 'css/content.css',`
