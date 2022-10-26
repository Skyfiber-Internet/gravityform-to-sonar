<?php declare(strict_types=1);

namespace Skyfiber\Models;

class Base
{
    public string $id;
    public string $form_id;
    public string $date_created;
    public string $ip;
    public string $source_url;
    public string $user_agent;
    public string $name;
    public string|null $company;

    /**
     * Assign attributes values based on json input
     *
     * Note: The attribute must exist on the model, either the Base or extended model.
     * You must also get the identifier from the GravityForm page.
     *
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        foreach ($args as $name => $value) {
            if (!is_int($name) && property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }

    /**
     * Get name or Name (Company) for form output
     *
     * @return string
     */
    public function getName(): string
    {
        if (!empty($this->company)) {
            return $this->name . ' (' . $this->company . ')';
        }

        return $this->name;
    }

    /**
     * Gets subject line with classname of form for subject name
     *
     * @return string
     */
    public function getSubject(): string
    {
        $reflect = new \ReflectionClass($this);

        return 'SkyFiber ' . $reflect->getShortName() . ' - ' . $this->getName();
    }

    /**
     * Iterate through all attributes and push them as a string
     *
     * @return string
     */
    public function __toString(): string
    {
        $return = '';
        foreach ($this->attributes() as $attributeName => $attributeValue) {
            $attributeName = str_replace('_', ' ', $attributeName);
            $return .= ucwords($attributeName) . ': ' . $attributeValue . '<br/>';
        }
        return $return;
    }

    public function attributes(): array
    {
        return get_object_vars($this);
    }
}