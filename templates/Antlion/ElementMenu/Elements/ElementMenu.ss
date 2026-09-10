<% cached $ID, $LastEdited, $Links.Count, $Links.Max('LastEdited') %>
<% if $Orientation == 'accordion' %>
    <ul class="menu vertical accordion-menu $MenuClasses" data-accordion-menu>
        <li>
            <% if $Title %>
                <a href="#" class="h2 element-title" style="padding-left:0px;padding-right:0px">$Title.XML</a>
            <% end_if %>
            <% if $Links.Exists %>
                <ul class="nested vertical menu is-active" style="margin:0px;">
                    <% loop $Links %>
                        <li style="border-bottom:1px solid silver">
                            <a class="$CssClass $ExtraClass"<% if $ModalTarget %> data-remodal-target="$ModalTarget"<% else %> href="$URL"<% end_if %><% if $OpenInNew %> target="_blank" rel="noopener noreferrer"<% end_if %>>$Title.XML</a>
                        </li>
                    <% end_loop %>
                </ul>
            <% end_if %>
        </li>
    </ul>
<% else %>
    <% if $Title && $ShowTitle %>
        <% with $HeadingTag %>
            <{$Me} class="element-title">$Up.Title.XML</{$Me}>
        <% end_with %>
    <% end_if %>

    <% if $Links.Exists %>
        <ul class="menu $MenuClasses">
            <% loop $Links %>
                <li>
                    <a class="$CssClass $ExtraClass"<% if $ModalTarget %> data-remodal-target="$ModalTarget"<% else %> href="$URL"<% end_if %><% if $OpenInNew %> target="_blank" rel="noopener noreferrer"<% end_if %>>$Title.XML</a>
                </li>
            <% end_loop %>
        </ul>
    <% end_if %>
<% end_if %>
<% end_cached %>
