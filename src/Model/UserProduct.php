<?php
namespace Model;

class UserProduct extends Model
{
    private int $id;
    private int $user_id;
    private int $product_id;
    private int $quantity;
    public function __construct(int $id, int $user_id, int $product_id, int $quantity)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
    public static function getCartProductsByUserId(int $userId): ?array
    {
        $stmt = static::getPdo()->prepare('SELECT * FROM user_products WHERE user_id = :userId');
        $stmt->execute(['userId' => $userId]);
        $data = $stmt->fetchAll();

        if (empty($data)) {
            return null;
        }

        return static::hydrateAll($data);
    }

    public static function getUserProduct(int $productId, int $userId): ?UserProduct
    {
        $stmt = static::getPdo()->prepare('SELECT * FROM user_products WHERE product_id = :productId AND user_id = :userId');
        $stmt->execute(['productId' => $productId, 'userId' => $userId]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return new UserProduct($data['id'], $data['user_id'], $data['product_id'], $data['quantity']);
    }

    public static function getUserProductQuantity(int $productId, int $userId) : ?int
    {
        $stmt = static::getPdo()->prepare('SELECT quantity FROM user_products WHERE product_id = :productId AND user_id = :userId');
        $stmt->execute(['productId' => $productId, 'userId' => $userId]);
        $data = $stmt->fetch();

        if (empty($data)) {
            return null;
        }

        return $data['quantity'];
    }

    public static function create(int $userId, int $productId, int $quantity) : void
    {
        $stmt = static::getPdo()->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:userId, :productId, :quantity)");
        $stmt->execute(['userId' => $userId, 'productId' => $productId, 'quantity' => $quantity]);
    }

    public function save(): void
    {
        $sql = 'UPDATE user_products SET quantity = :quantity WHERE product_id = :productId AND user_id = :userId';
        $stmt = static::getPdo()->prepare($sql);
        $stmt->execute(['quantity' => $this->quantity, 'productId' => $this->productId, 'userId' => $this->userId]);
    }

    public function destroy() : void
    {
        $stmt = static::getPdo()->prepare('DELETE FROM user_products WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
    }

    public static function getCount(int $userId) : int
    {
        $stmt = static::getPdo()->prepare('SELECT SUM(user_products.quantity) FROM user_products WHERE user_products.user_id = :userId');
        $stmt->execute(['userId' => $userId]);
        $result = $stmt->fetch();

        return $result['sum'] ?? 0;
    }

    public function incrementQuantity() : void
    {
        if ($this->getQuantity() > 0) {
            $this->quantity++;
            $this->save();
        }
    }

    public function decrementQuantity() : void
    {
        if ($this->getQuantity() === 1) {
            $this->destroy();
        } else {
            $this->quantity--;
            $this->save();
        }
    }

    private static function hydrateAll(array $data) : array
    {
        $result = [];
        foreach ($data as $userProduct) {
            $result[] = new UserProduct($userProduct['id'], $userProduct['user_id'], $userProduct['product_id'], $userProduct['quantity']);
        }

        return $result;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}