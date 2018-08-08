##### template using directive
> error
```angular2html
# type = 'modal' || 'alert' (default: 'alert')
# alert = 'warning' || 'danger' (default: 'danger')
# small = boolean (default: false)
<error [error]="error" [small]="true" [type]="'modal'" [alert]="'warning'"></error>
```