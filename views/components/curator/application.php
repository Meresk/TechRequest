<?php
/**
 * @var \App\Models\Application $application
 *@var \App\Models\User $user
 */
?>

<tr>
    <td style="width: 200px;"><?php echo $application->id() ?></td>
    <td style="width: 200px;"><?php echo $application->status() ?></td>
    <td style="width: 200px;"><?php echo $user->name() ?></td>
    <td>
        <div class="dropdown d-flex justify-content-end">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Действия </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="curator/application?id=<?php echo $application->id() ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-lg" viewBox="0 0 16 16">
                            <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0"/>
                        </svg>
                        <span>Подробности</span>
                    </a>
                </li>
                <li>
                    <form action="/" method="post">
                        <input type="hidden" name="id" value="<?php echo $application->id() ?>">
                        <button class="dropdown-item" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                            </svg>
                            <span>Назначить исполнителя</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </td>
</tr>