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

### Shortcode: ```[breadcrumb]``` ```[breadcrumb-item]```

![](images/breadcrumb-shortcode.jpg)

```
[breadcrumb][breadcrumb-item link="https://test.de"]Lorem[/breadcrumb-item][breadcrumb-item link="https://test.de"]Ipsum[/breadcrumb-item][breadcrumb-item active="true"]Dolor[/breadcrumb-item][/breadcrumb]
```

This has to be in one line, because of the way the WordPress editor is handling line breaks.

The ```[button]``` shortcode generates a link-button styled with bootstrap.

Accepted options are:
- type => default, primary, success, info, warning, danger, link (default when not given: default)
- size => lg, sm, xs
- link => Your link
- target => _blank, _new (default when not given opens the link in the same page)

![](images/button-shortcode.jpg)

Examples Button Type:

![](images/buttons-type.png)

Examples Button Size:

![](images/buttons-size.png)

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

### Shortcode: ```[carousel]``` ```[carousel-item]```

![](images/carousel-shortcode.jpg)

```
[carousel][carousel-item]<img class="alignnone size-large wp-image-1896" src="image_1.jpg" alt="" width="1030" height="547" />[/carousel-item][carousel-item]<img class="alignnone size-large wp-image-1895" src="image_2.jpg" alt="" width="1030" height="547" />[/carousel-item][/carousel]
```

This has to be in one line, because of the way the WordPress editor is handling line breaks.

### Shortcode: ```[accordion]``` ```[accordion-item]``` ```[accordion-group]```

![](images/accordion-shortcode.jpg)

Accordion Group:
```
[accordion-group][accordion title="Accordion 1"][accordion-item]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat gravida turpis nec fringilla. Integer malesuada consectetur nibh. Donec at volutpat orci, vitae congue risus. Nullam aliquam dolor vel dolor blandit fringilla. Aliquam ultricies diam sed mauris feugiat rutrum nec et ante. Nam mattis quam eget aliquet commodo. Fusce feugiat urna tellus, vitae dictum velit eleifend a. Integer quis interdum nisl, vitae commodo tellus.[/accordion-item][/accordion][accordion title="Accordion 2"][accordion-item]Vivamus non metus vel risus commodo eleifend. In a fringilla metus. Praesent tempus velit ligula, non sollicitudin ligula dictum ac. Proin dignissim, risus at laoreet elementum, turpis leo sodales dui, vel pulvinar sem purus ac enim. Aliquam massa elit, pulvinar nec metus maximus, fringilla fermentum sem. Curabitur et lorem venenatis, volutpat lacus aliquet, volutpat eros. Integer malesuada, purus nec luctus suscipit, nulla lorem aliquet enim, ac condimentum orci mi a tellus. Cras a volutpat magna. Cras odio est, sollicitudin a velit sit amet, lobortis tempor velit. Etiam at diam nulla. Suspendisse potenti.[/accordion-item][/accordion][/accordion-group]
```

Single Accordion:
```
[accordion title="Accordion 3"][accordion-item]Vivamus non metus vel risus commodo eleifend. In a fringilla metus. Praesent tempus velit ligula, non sollicitudin ligula dictum ac. Proin dignissim, risus at laoreet elementum, turpis leo sodales dui, vel pulvinar sem purus ac enim. Aliquam massa elit, pulvinar nec metus maximus, fringilla fermentum sem. Curabitur et lorem venenatis, volutpat lacus aliquet, volutpat eros. Integer malesuada, purus nec luctus suscipit, nulla lorem aliquet enim, ac condimentum orci mi a tellus. Cras a volutpat magna. Cras odio est, sollicitudin a velit sit amet, lobortis tempor velit. Etiam at diam nulla. Suspendisse potenti.[/accordion-item][/accordion]
```

This has to be in one line, because of the way the WordPress editor is handling line breaks.

### Shortcode: ```[nav]``` ```[nav-item]``` and ```[dropdown]``` ```[dropdown-header]``` ```[dropdown-item]```

![](images/navigation-shortcode.jpg)

```
[nav][nav-item link="https://test.de"]Nav-Item[/nav-item][nav-item dropdown="true" link="https://test.de"]Nav-Item Dropdown[dropdown][dropdown-header]Dropdown Header[/dropdown-header][dropdown-item link="https://test.de"]Dropdown Item[/dropdown-item][/dropdown][/nav-item][nav-item link="https://test.de" disabled="true"]Nav-Item Disabled[/nav-item][/nav]
```

This has to be in one line, because of the way the WordPress editor is handling line breaks.

### Shortcode: ```[progress]``` ```[progress-bar]```

![](images/pregress-shortcode.jpg)

```
[progress striped="true"][progress-bar percent="75" label="true"][/progress-bar][/progress]

[progress][progress-bar percent="42" label="true" type="success"][/progress-bar][/progress]

[progress striped="true" animated="true"][progress-bar percent="15" label="true" type="info"][/progress-bar][/progress]

[progress][progress-bar percent="23" label="true" type="warning"][/progress-bar][/progress]

[progress][progress-bar percent="81" label="true" type="danger"][/progress-bar][/progress]
```

The shortcode combination for a single progress bar has to be in one line, because of the way the WordPress editor is handling line breaks.
