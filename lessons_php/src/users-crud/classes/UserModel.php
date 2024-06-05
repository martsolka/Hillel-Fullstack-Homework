<?php
class UserModel extends AbstractModel
{
  const DEFAULT_ADMIN = [
    'name' => 'Solomia Martyniuk',
    'email' => 'martsolka@admin.com',
    'password' => 'admin123',
    'role' => Role::ROOT->value,
    'gender' => Gender::FEMALE->value,
    'country' => Country::UKRAINE->value,
    'date_of_birth' => '2002-02-01',
  ];

  public function __construct()
  {
    parent::__construct('users');
    !$this->isTableExists() && $this->initTable();
  }

  protected function initTable(): void
  {
    $roles = implode(', ', array_map(fn ($role) => "'$role'", Role::values()));
    $defaultRole = Role::STUDENT->value;
    $genders = implode(', ', array_map(fn ($gender) => "'$gender'", Gender::values()));

    $this->exec("CREATE TABLE `{$this->table}` (
      `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      `name` varchar(50) NOT NULL,
      `email` varchar(100) NOT NULL UNIQUE,
      `password` varchar(255) NOT NULL,
      `role` enum({$roles}) NOT NULL DEFAULT '{$defaultRole}',
      `gender` enum({$genders}) DEFAULT NULL,
      `country` varchar(5) DEFAULT NULL,
      `date_of_birth` DATE DEFAULT NULL,
      `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `updated_at` TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
    )");

    parent::create(array_merge(self::DEFAULT_ADMIN, ['password' => $this->hashPassword(self::DEFAULT_ADMIN['password'])]));
  }

  public function hashPassword(?string $password): string
  {
    return md5($password ?? '');
  }

  protected function isValidBeforeSave(array $data, bool $isUpdate = false): bool
  {
    $rules = [
      'name' => [new RequiredRule, new MinLengthRule(3), new MaxLengthRule(50), new RegexRule('/^[a-zA-Z]+(?: [a-zA-Z]+)?$/', 'Only letters and space between words are allowed')],
      'email' => [new RequiredRule, new EmailRule(), new MaxLengthRule(100), new CustomRule(fn ($value) => $this->read(where: ['email' => $value]) === [], 'Email is already taken')],
      'password' => [new RequiredRule, new MinLengthRule(8), new RegexRule('/^[A-Za-z\d]+$/', 'Password must contain only letters and numbers')],
      'confirmPassword' => [new RequiredRule, new EqualRule('password')],
      'role' => [new RequiredRule, new EnumRule(Role::withoutRoot(true))],
      'gender' => [new EnumRule(Gender::values())],
      'country' => [new MaxLengthRule(5), new EnumRule(Country::values())],
      'date_of_birth' => [new DateFormatRule],
    ];

    if ($isUpdate) {
      ['email' => $currentEmail, 'password' => $currentPassword] = $this->read($data['id'], ['email', 'password']);

      if ($currentEmail === $data['email']) {
        unset($rules['email']);
      }

      if ($currentPassword === $this->hashPassword($data['password']) || empty($data['password'])) {
        unset($rules['password'], $data['password'], $rules['confirmPassword'], $data['confirmPassword']);
      }
    }

    return FormValidator::isValid($data, $rules);
  }

  public function create(array $data): int
  {
    $data = array_map(fn ($value) => $value ?: null, $data);
    if (!$this->isDefaultAdmin($data) && !$this->isValidBeforeSave($data)) {
      return false;
    }
    $data['password'] = $this->hashPassword($data['password']);
    unset($data['confirmPassword']);

    return parent::create($data);
  }

  public function update(int $id, array $data): bool
  {
    $data = array_map(fn ($value) => $value ?: null, $data);
    if (!$this->isValidBeforeSave($data, true)) {
      return false;
    }

    if (!empty($data['password'])) {
      $data['password'] = $this->hashPassword($data['password']);
    } else {
      unset($data['password']);
    }
    unset($data['confirmPassword']);

    return parent::update($id, $data);
  }

  public function isDefaultAdmin(array $data): bool
  {
    if (isset($data['email'])) {
      return $data['email'] === self::DEFAULT_ADMIN['email'] && $data['password'] === $this->hashPassword(self::DEFAULT_ADMIN['password']);
    }

    if (isset($data['id'])) {
      return $this->read($data['id'], ['email'])['email'] === self::DEFAULT_ADMIN['email'];
    }

    return false;
  }
}
