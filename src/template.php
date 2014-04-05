$projects = array();

$project = new Sismo\Project('<?=$name?>');
$project->setRepository('<?=$repository?>');
$project->setBranch('<?=$branch?>');
$project->setCommand(
    '<?=$commands?>'
);
$project->setSlug('<?=$slug?>');
$project->setUrlPattern('<?=$urlPattern?>');
$project->addNotifier('<?=$notifier?>');
$projects[] = $project;

return $projects;