package test;

import static org.junit.jupiter.api.Assertions.*;

import java.time.Duration;

import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

class IndigoTest {
	
	private static WebDriver webDriver;
	private static String baseUrl;
	private static WebDriverWait wait;

	@BeforeAll
	static void setUpBeforeClass() throws Exception {
		System.setProperty("webdriver.chrome.driver", "C:\\Users\\Administrator\\Desktop\\chromedriver_2.exe");
		webDriver = new ChromeDriver();
		webDriver.manage().window().maximize();
		baseUrl = "https://indigo-events-app.herokuapp.com/index.html";
		
		wait = new WebDriverWait(webDriver, Duration.ofSeconds(5));
	}

	@AfterAll
	static void tearDownAfterClass() throws Exception {
		webDriver.close();
	}

	@Test
	void testLogin() throws InterruptedException {
		webDriver.get(baseUrl);
		
		wait.until(ExpectedConditions.visibilityOfElementLocated(By.cssSelector("#navbarNav > ul > li:nth-child(3) > a"))).click(); //select login
		WebElement username = wait.until(ExpectedConditions.visibilityOfElementLocated(By.name("username")));
		username.sendKeys("Dzenimed");
		
		WebElement password = wait.until(ExpectedConditions.visibilityOfElementLocated(By.name("password")));
		username.sendKeys("dzenispass");
		
		wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath("//*[@id=\"login-form\"]/button"))).click();
		
		
		WebElement title = wait.until(ExpectedConditions.visibilityOfElementLocated(By.cssSelector("body > nav > div > a")));
		assertEquals("IndigoEvents", title.getText());
		Thread.sleep(5000);
	}
	
	@Test
	void testLogout() throws InterruptedException {
		webDriver.get(baseUrl);
		
		wait.until(ExpectedConditions.visibilityOfElementLocated(By.cssSelector("#navbarNav > ul > li:nth-child(3) > a"))).click(); //select login
		WebElement username = wait.until(ExpectedConditions.visibilityOfElementLocated(By.name("username")));
		username.sendKeys("Dzenimed");
		
		WebElement password = wait.until(ExpectedConditions.visibilityOfElementLocated(By.name("password")));
		username.sendKeys("dzenispass");
		
		wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath("//*[@id=\"login-form\"]/button"))).click();
		Thread.sleep(2000);
		
		wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath("//*[@id=\"navbarNav\"]/ul/li[3]/a"))).click(); //do login
		assertEquals("https://indigo-events-app.herokuapp.com/index.html", webDriver.getCurrentUrl()); // cannot login before logout
		
		wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath("//*[@id=\"navbarNav\"]/ul/li[4]/a"))).click(); //do logut
		assertEquals("https://indigo-events-app.herokuapp.com/index.html", webDriver.getCurrentUrl()); // user can still see main page
		
		wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath("//*[@id=\"navbarNav\"]/ul/li[3]/a"))).click(); //do login
		assertEquals("https://indigo-events-app.herokuapp.com/login.html", webDriver.getCurrentUrl()); //after logout user can login again
	}
	
	@Test
	void testViewMore() {
		webDriver.get(baseUrl);
		
		wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath("/html/body/div[2]/div[1]/div[2]/div[2]/p[3]/button"))).click();
		WebElement veiwMore = wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath("//*[@id=\"exampleModalLabel\"]")));
		assertEquals("About this event", veiwMore.getText()); //view more option pops up	
	}

}
