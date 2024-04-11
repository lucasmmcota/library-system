<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Method to exclude indexes of array
     * @access protected
     * @param array $array
     * @param array $indexRemove array of index to remove
     * @return array array filtered
     */
    protected function arrayFilter($array, $indexRemove)
    {
        foreach ($indexRemove as $index) {
            unset($array[$index]);
        }
        
        return array_values($array);
    }

    /**
     * Method to format cpf number
     * @access protected
     * @param string $cpf
     * @return string
     */
    protected function formatCpf(string $cpf)
    {
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9);
    }

    /**
     * Method to return the date in br format if is not null
     * @access protected
     * @param string $date
     * @return string
     */
    protected function getDateBr(string $date)
    {
        return date('d/m/Y', strtotime($date));
    }

    /**
     * Method to get an icon to a new page
     * @access protected
     * @param string $id
     * @param string $route
     * @param string $method
     * @param string $icon
     * @param string $target
     * @param string $title
     * @return array
     */
    protected function getIconNewPage(
        string $id,
        string $route,
        string $method,
        string $icon,
        string $target = null,
        string $title = null
    )
    {
        return [
            'id' => $id,
            'route' => $route . '/' . $id . '/' . $method,
            'icon' => $icon,
            'target' => $target,
            'title' => $title
        ];
    }

    /**
     * Method to get an icon to a modal
     * @access protected
     * @param string $id
     * @param string $modalName
     * @param string $route
     * @param string $title
     * @param string $message
     * @param string $icon
     * @param string $httpMethod
     * @return array
     */
    protected function getIconModal(
        string $id,
        string $modalName,
        string $route,
        string $title,
        string $message,
        string $icon,
        string $httpMethod
    )
    {
        return [
            'id' => $id,
            'title' => $title,
            'dataTarget' => '#' . $modalName . '_' . $id,
            'route' => $route . '/' . serialize($id),
            'icon' => $icon,
            'dataToggle' => 'modal',
            'method' => $httpMethod,
            'message' => $message
        ];
    }

    /**
     * Method to get the edit icon
     * @access protected
     * @param string $id
     * @param string $route
     * @return array
     */
    protected function getIconEdit(string $id, string $route, string $title)
    {
        return $this->getIconNewPage($id, $route, 'edit', 'fa-regular fa-pen-to-square', null, $title);
    }

    /**
     * Method to get the delete icon
     * @access protected
     * @param string $id
     * @param string $modalName
     * @param string $route
     * @param string $title
     * @param string $message
     * @return array
     */
    protected function getIconDelete(string $id, string $modalName, string $route, string $title, string $message)
    {
        return $this->getIconModal(
            $id,
            $modalName,
            $route,
            $title,
            $message,
            'fa-solid fa-trash-can',
            'delete'
        );
    }
}
