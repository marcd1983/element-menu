<% if $Title && $ShowTitle %>
    <% with $HeadingTag %>
        <{$Me} class="element-title">$Up.Title.XML</{$Me}>
    <% end_with %>
<% end_if %>

<% if $Links.Exists %>
<ul class="menu $MenuClasses">
    <% loop $Links %>
        <li><a href="$URL"<% if $OpenInNew %> target="_blank" rel="noopener noreferrer"<% end_if %>>$Title.XML</a></li>
    <% end_loop %>
</ul>
<% end_if %>
