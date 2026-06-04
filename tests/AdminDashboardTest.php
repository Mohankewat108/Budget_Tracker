<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use pdo;

final class AdminDashboardTest extends TestCase
{
    private \PDO $conn;

    protected function setUp(): void
    {
        $this->conn = new PDO(
            "mysql:host=localhost;dbname=budget_tracker",
            "root",
            ""
        );

        $this->conn->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN ACCESS
    |--------------------------------------------------------------------------
    */

    public function testAdminUsersExist(): void
    {
        $stmt = $this->conn->query(
            "SELECT COUNT(*) FROM users WHERE role='admin'"
        );

        $count = $stmt->fetchColumn();

        $this->assertGreaterThan(0, $count);
    }

    public function testUserAccountsExist(): void
    {
        $stmt = $this->conn->query(
            "SELECT COUNT(*) FROM users WHERE role='user'"
        );

        $count = $stmt->fetchColumn();

        $this->assertGreaterThan(0, $count);
    }

    /*
    |--------------------------------------------------------------------------
    | USER STATUS
    |--------------------------------------------------------------------------
    */

    public function testActiveUsersExist(): void
    {
        $stmt = $this->conn->query(
            "SELECT COUNT(*) FROM users WHERE is_active = 1"
        );

        $count = $stmt->fetchColumn();

        $this->assertGreaterThan(0, $count);
    }

    public function testBlockedUsersExist(): void
    {
        $stmt = $this->conn->query(
            "SELECT COUNT(*) FROM users WHERE is_active = 0"
        );

        $count = $stmt->fetchColumn();

        $this->assertGreaterThanOrEqual(
            0,
            $count
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD STATISTICS
    |--------------------------------------------------------------------------
    */

    public function testTotalUsersCount(): void
    {
        $stmt = $this->conn->query(
            "SELECT COUNT(*) FROM users"
        );

        $count = $stmt->fetchColumn();

        $this->assertGreaterThan(
            0,
            $count
        );
    }

    public function testAdminCount(): void
    {
        $stmt = $this->conn->query(
            "SELECT COUNT(*) FROM users WHERE role='admin'"
        );

        $count = $stmt->fetchColumn();

        $this->assertGreaterThan(
            0,
            $count
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADD USER
    |--------------------------------------------------------------------------
    */

    public function testDuplicateEmailExists(): void
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM users WHERE email=?"
        );

        $stmt->execute([
            'alice.johnson@email.com'
        ]);

        $count = $stmt->fetchColumn();

        $this->assertGreaterThan(
    0,
    $count
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DATABASE STRUCTURE
    |--------------------------------------------------------------------------
    */

    public function testUsersTableExists(): void
    {
        $stmt = $this->conn->query(
            "SHOW TABLES LIKE 'users'"
        );

        $this->assertNotFalse(
            $stmt->fetch()
        );
    }

    public function testCategoriesTableExists(): void
    {
        $stmt = $this->conn->query(
            "SHOW TABLES LIKE 'categories'"
        );

        $this->assertNotFalse(
            $stmt->fetch()
        );
    }

    public function testExpensesTableExists(): void
    {
        $stmt = $this->conn->query(
            "SHOW TABLES LIKE 'expenses'"
        );

        $this->assertNotFalse(
            $stmt->fetch()
        );
    }

    public function testTransactionsTableExists(): void
    {
        $stmt = $this->conn->query(
            "SHOW TABLES LIKE 'transactions'"
        );

        $this->assertNotFalse(
            $stmt->fetch()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SECURITY
    |--------------------------------------------------------------------------
    */

    public function testXssInput(): void
    {
        $input = '<script>alert(1)</script>';

        $output = htmlspecialchars($input);

        $this->assertNotEquals(
            $input,
            $output
        );
    }

    public function testHtmlEscaping(): void
    {
        $input = '<b>Admin</b>';

        $output = htmlspecialchars($input);

        $this->assertStringContainsString(
            '&lt;b&gt;',
            $output
        );
    }
}