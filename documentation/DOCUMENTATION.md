# Shortcodes

### Shortcode: ```[alert]```

![](images/alert-shortcode.jpg)

```
[alert]Lorem Ipsum[/alert]

[alert type="info" dismissable="true"]Lorem Ipsum[/alert]

[alert type="warning" dismissable="true"]Lorem Ipsum[/alert]

[alert type="danger" dismissable="true"]Lorem Ipsum[/alert]
```

### Shortcode: ```[badge]```

![](images/badge-shortcode.jpg)

```
Badge [badge]42[/badge]

Badge [badge right="true"]42[/badge]
```

### Shortcode: ```[breadcrumb]``` and ```[breadcrumb-item]```

![](images/breadcrumb-shortcode.jpg)

```
[breadcrumb][breadcrumb-item link="https://test.de"]Lorem[/breadcrumb-item][breadcrumb-item link="https://test.de"]Ipsum[/breadcrumb-item][breadcrumb-item active="true"]Dolor[/breadcrumb-item][/breadcrumb]
```

This has to be in one line, because of the way the WordPress editor is handling line breaks.

### Shortcode: ```[button]``` and ```[button-group]``` and ```[button-toolbar]```

![](images/button-shortcode.jpg)

```
[button link="https://test.de" target="_blank" title="Test Button"]Button[/button]
```

```
[button-group][button link="https://test.de" target="_blank" title="Test Button 1"]Button 1[/button][button link="https://test.de" target="_blank" title="Test Button 2"]Button 2[/button][/button-group]
```

```
[button-toolbar][button-group][button link="https://test.de" target="_blank" title="Test Button 1 Group 1"]Group 1 - Button 1[/button][button link="https://test.de" target="_blank" title="Test Button 2 Group 1"]Group 1 - Button 2[/button][/button-group][button-group][button link="https://test.de" target="_blank" title="Test Button 1 Group 2"]Group 2 - Button 1[/button][button link="https://test.de" target="_blank" title="Test Button 2 Griup 2"]Group 2 - Button 2[/button][/button-group][/button-toolbar]
```

This has to be in one line, because of the way the WordPress editor is handling line breaks.
